<?php

namespace App\Controller;

use App\Entity\Assessment;
use App\Form\AssessmentType;
use App\Repository\AssessmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/assessment')]
final class AssessmentController extends AbstractController
{
    #[Route(name: 'app_assessment_index', methods: ['GET'])]
    public function index(AssessmentRepository $assessmentRepository): Response
    {
        return $this->render('assessment/index.html.twig', [
            'assessments' => $assessmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_assessment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $assessment = new Assessment();
        $form = $this->createForm(AssessmentType::class, $assessment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($assessment);
            $entityManager->flush();

            return $this->redirectToRoute('app_assessment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('assessment/new.html.twig', [
            'assessment' => $assessment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assessment_show', methods: ['GET'])]
    public function show(Assessment $assessment): Response
    {
        return $this->render('assessment/show.html.twig', [
            'assessment' => $assessment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_assessment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Assessment $assessment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AssessmentType::class, $assessment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_assessment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('assessment/edit.html.twig', [
            'assessment' => $assessment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assessment_delete', methods: ['POST'])]
    public function delete(Request $request, Assessment $assessment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assessment->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($assessment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_assessment_index', [], Response::HTTP_SEE_OTHER);
    }
}
