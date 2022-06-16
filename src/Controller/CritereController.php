<?php

namespace App\Controller;

use App\Repository\CritereRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Critere;
use App\Form\CritereType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CritereController extends AbstractController
{
    #[Route('/critere', name: 'app_critere')]
    public function index(): Response
    {
        return $this->render('critere/login.html.twig', [
            'controller_name' => 'CritereController',
        ]);
    }

    #[Route('/save', name: 'critere_save')]
    public function save(Request $request,ManagerRegistry $doctrine): Response
    {
        $critere = new Critere();
        $form = $this->createForm(CritereType::class,$critere);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            if ($form->isValid()) {
                $entityManager = $doctrine->getManager();
                $entityManager->persist($critere);
                $entityManager->flush();
            }
        }
        return $this->render('critere/save.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    #[Route('/update', name: 'critere_update')]
    public function update(): Response
    {
        return $this->render('critere/update.html.twig');
    }

    #[Route('/getAll', name: 'critere_getAll')]
    public function getAll(CritereRepository $criteres ): Response
    {

        return $this->render('critere/getAll.html.twig',[
            'criteres'=>$criteres->findAll()
        ]);
    }

    #[Route('/delete', name: 'critere_delete')]
    public function delete($id): Response
    {
        return $this->render('critere/delete.html.twig');
    }

    #[Route('/edit', name: 'critere_edit')]
    public function edit($id): Response
    {
        return $this->render('critere/edit.html.twig');
    }
}
