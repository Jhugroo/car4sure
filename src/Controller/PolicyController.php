<?php

namespace App\Controller;

use App\Entity\Policy;
use App\Form\PolicyType;
use App\Repository\PolicyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/policy')]
class PolicyController extends AbstractController {
    #[Route('/', name: 'app_policy_index', methods: ['GET'])]
    public function index(PolicyRepository $policyRepository): Response {
        return $this->render('policy/index.html.twig', [
            'policies' => $policyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_policy_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response {
        $policy = new Policy();
        $form = $this->createForm(PolicyType::class, $policy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($policy);
            $entityManager->flush();

            return $this->redirectToRoute('app_policy_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('policy/new.html.twig', [
            'policy' => $policy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_policy_show', methods: ['GET'])]
    public function show(Policy $policy): Response {
        return $this->render('policy/show.html.twig', [
            'policy' => $policy,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_policy_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Policy $policy, EntityManagerInterface $entityManager): Response {

        $form = $this->createForm(PolicyType::class, $policy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_policy_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('policy/edit.html.twig', [
            'policy' => $policy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_policy_delete', methods: ['POST'])]
    public function delete(Request $request, Policy $policy, EntityManagerInterface $entityManager): Response {
        if ($this->isCsrfTokenValid('delete' . $policy->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($policy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_policy_index', [], Response::HTTP_SEE_OTHER);
    }
}
