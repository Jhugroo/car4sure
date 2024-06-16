<?php

namespace App\Controller;

use App\Entity\Coverage;
use App\Form\CoverageType;
use App\Repository\CoverageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/coverage')]
class CoverageController extends AbstractController {
    #[Route('/', name: 'app_coverage_index', methods: ['GET'])]
    public function index(CoverageRepository $coverageRepository): Response {
        return $this->render('coverage/index.html.twig', [
            'coverages' => $coverageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_coverage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response {
        $coverage = new Coverage();
        $form = $this->createForm(CoverageType::class, $coverage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coverage);
            $entityManager->flush();

            return $this->redirectToRoute('app_coverage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coverage/new.html.twig', [
            'coverage' => $coverage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coverage_show', methods: ['GET'])]
    public function show(Coverage $coverage): Response {
        return $this->render('coverage/show.html.twig', [
            'coverage' => $coverage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coverage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Coverage $coverage, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(CoverageType::class, $coverage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_coverage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coverage/edit.html.twig', [
            'coverage' => $coverage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coverage_delete', methods: ['POST'])]
    public function delete(Request $request, Coverage $coverage, EntityManagerInterface $entityManager): Response {
        if ($this->isCsrfTokenValid('delete' . $coverage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($coverage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_coverage_index', [], Response::HTTP_SEE_OTHER);
    }
}
