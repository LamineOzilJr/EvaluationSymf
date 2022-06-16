<?php

namespace App\Controller;

use App\Entity\Critere;
use App\Entity\Indicateur;
use App\Form\CritereType;
use App\Form\IndicateurType;
use App\Repository\IndicateurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndicateurController extends AbstractController
{
    #[Route('/indicateur', name: 'app_indicateur')]
    public function index(): Response
    {
        return $this->render('indicateur/index.html.twig', [
            'controller_name' => 'IndicateurController',
        ]);
    }

    #[Route('/Indicateur/save', name: 'indicateur_save')]
    public function save(Request $request,ManagerRegistry $doctrine): Response
    {
        $indicateur = new Indicateur();
        $form = $this->createForm(IndicateurType::class,$indicateur);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            if ($form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->persist($indicateur);
                $entityManager->flush();
            }
        }
        return $this->render('indicateur/save.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    #[Route('/Indicateur/update', name: 'indicateur_update')]
    public function update(): Response
    {
        return $this->render('indicateur/update.html.twig');
    }

    #[Route('/Indicateur/getAll', name: 'indicateur_getAll')]
    public function getAll(IndicateurRepository $indicateurs): Response
    {
        return $this->render('indicateur/getAll.html.twig',[
            'indicateurs'=>$indicateurs->findAll()
        ]);
    }

    #[Route('/delete', name: 'indicateur_delete')]
    public function delete($id): Response
    {
        return $this->render('indicateur/delete.html.twig');
    }
}
