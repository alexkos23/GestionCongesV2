<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\DemandeType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Demande;

class DemandeController extends AbstractController
{
    #[Route('/demande', name: 'app_demande')]
    public function index(): Response
    {
        return $this->render('demande/index.html.twig', [
            'controller_name' => 'DemandeController',
        ]);
    }
    public function showAllDemandes(ManagerRegistry $doctrine): Response
    {
        $Demande= $doctrine->getRepository(Demande::class)->findAll();

        
        //echo("On a recupéré ".$Demande>getNom());
        
        
        return $this->render('demande/show_all_Demandes.html.twig', ['Demande' => $Demande]);
    }
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $Demande = new Demande();
        $formDemande = $this->createForm(DemandeType::class, $Demande);

        $formDemande->handleRequest($request);
            if ($formDemande->isSubmitted() && $formDemande->isValid()){
                $Demande = $formDemande->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($Demande);
                $entityManager->flush();

                return $this->redirectToRoute('show_all_Demandes');
            }

        return $this->render('demande/new.html.twig',[
            'formDemande' => $formDemande->createView()]); 
    }
}
