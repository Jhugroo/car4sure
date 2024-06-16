<?php

namespace App\Controller;

use App\Entity\PolicyHolder;
use App\Form\PolicyHolderType;
use App\Repository\PolicyHolderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/policy/holder')]
class PolicyHolderController extends AbstractController {
    #[Route('/', name: 'app_policy_holder_index', methods: ['GET'])]
    public function index(PolicyHolderRepository $policyHolderRepository): Response {
        return $this->render('policy_holder/index.html.twig', [
            'policy_holders' => $policyHolderRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_policy_holder_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response {
        $policyHolder = new PolicyHolder();
        $form = $this->createForm(PolicyHolderType::class, $policyHolder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($policyHolder);
            $entityManager->flush();

            return $this->redirectToRoute('app_policy_holder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('policy_holder/new.html.twig', [
            'policy_holder' => $policyHolder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_policy_holder_show', methods: ['GET'])]
    public function show(PolicyHolder $policyHolder): Response {
        return $this->render('policy_holder/show.html.twig', [
            'policy_holder' => $policyHolder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_policy_holder_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PolicyHolder $policyHolder, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(PolicyHolderType::class, $policyHolder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_policy_holder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('policy_holder/edit.html.twig', [
            'policy_holder' => $policyHolder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_policy_holder_delete', methods: ['POST'])]
    public function delete(Request $request, PolicyHolder $policyHolder, EntityManagerInterface $entityManager): Response {
        if ($this->isCsrfTokenValid('delete' . $policyHolder->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($policyHolder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_policy_holder_index', [], Response::HTTP_SEE_OTHER);
    }
}
