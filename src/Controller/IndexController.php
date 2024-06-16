<?php

namespace App\Controller;

use App\Repository\DriverRepository;
use App\Repository\PolicyRepository;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class IndexController extends AbstractController {
    #[Route('/', name: 'app_index', methods: ['GET'])]
    public function index(PolicyRepository $policyRepository, DriverRepository $driverRepository, VehicleRepository $vehicleRepository, AuthenticationUtils $authenticationUtils): Response {
        if ($authenticationUtils->getLastUsername()) {

            return $this->render('index/index.html.twig', [
                'policies' => $policyRepository->findAll(),
                'vehicles' => $vehicleRepository->findAll(),
                'drivers' => $driverRepository->findAll()
            ]);
        }
        return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
    }
}
