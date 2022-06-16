<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Entity\Indicateur;
use App\Form\EvaluationType;
use App\Form\IndicateurType;
use App\Repository\EvaluationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvaluationController extends AbstractController
{
    #[Route('/evaluation', name: 'app_evaluation')]
    public function index(): Response
    {
        return $this->render('evaluation/login.html.twig', [
            'controller_name' => 'EvaluationController',
        ]);
    }

    #[Route('/evaluation/save', name: 'evaluation_save')]
    public function save(Request $request,ManagerRegistry $doctrine): Response
    {
        $evaluation = new Evaluation();
        $form = $this->createForm(EvaluationType::class,$evaluation);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            if ($form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->persist($evaluation);
                $entityManager->flush();
            }
        }
        return $this->render('evaluation/save.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    #[Route('/evaluation//update', name: 'evaluation_update')]
    public function update(): Response
    {
        return $this->render('evaluation/update.html.twig');
    }

    #[Route('/evaluation/getAll', name: 'evaluation_getAll')]
    public function getAll(EvaluationRepository $evaluations): Response
    {
        return $this->render('evaluation/getAll.html.twig',[
            'evaluations'=>$evaluations->findAll()
        ]);
    }

    #[Route('/evaluation/delete', name: 'evaluation_delete')]
    public function delete($id): Response
    {
        return $this->render('evaluation/delete.html.twig');
    }
}
