<?php

namespace App\Controller;

use App\Entity\Employes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\EmployesType;
use Symfony\Component\HttpFoundation\Request;

class EmployesController extends AbstractController
{
    #[Route('/employes', name: 'app_employes')]
    public function index(): Response
    {
        return $this->render('employes/index.html.twig', [
            'controller_name' => 'EmployesController',
        ]);
    }
    public function add(ManagerRegistry $doctrine): Response{
        
        $entityManager = $doctrine->getManager();
        $employe = new Employes();
        $employe->setNom('Alex');
        $employe->setPrenom('Koskas');
        $employe->setEmail('alex@gmail.com');
        $employe->setTypeContrat('Alternance');

        $entityManager->persist($employe);
        $entityManager->flush();

        return new Response('Nouvel util'.$employe->getNom());

    }
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $employe = $doctrine->getRepository(Employes::class)->find($id);
        if( !$employe){
            throw $this->createNoFoundException(
                'Aucun employé trouvé pour cet id'.$id
            );
        }
        //return new Response("On a trouvé l'employé".$employe->getNom());

        return $this->render('employes/show_employe.html.twig', ['employe' => $employe]);
    }
    public function showAll(ManagerRegistry $doctrine): Response
    {
        $employe = $doctrine->getRepository(Employes::class)->findAll();

        
        //echo("On a recupéré ".$employe->getNom());
        
        
        return $this->render('employes/show_all_employes.html.twig', ['employes' => $employe]);
    }
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $employe = new Employes();
        $formEmploye = $this->createForm(EmployesType::class, $employe);

        $formEmploye->handleRequest($request);
            if ($formEmploye->isSubmitted() && $formEmploye->isValid()){
                $employe = $formEmploye->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($employe);
                $entityManager->flush();

                return $this->redirectToRoute('show_all_employes');
            }

        return $this->render('employes/new.html.twig',['form' => $formEmploye->createView()]); 
    }
}
