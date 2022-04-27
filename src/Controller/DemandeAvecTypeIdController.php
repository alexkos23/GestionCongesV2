<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\Demande2Type;
use App\Repository\DemandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/demande/avec/type/id')]
class DemandeAvecTypeIdController extends AbstractController
{
    #[Route('/', name: 'app_demande_avec_type_id_index', methods: ['GET'])]
    public function index(DemandeRepository $demandeRepository): Response
    {
        return $this->render('demande_avec_type_id/index.html.twig', [
            'demandes' => $demandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_demande_avec_type_id_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DemandeRepository $demandeRepository): Response
    {
        $demande = new Demande();
        $form = $this->createForm(Demande2Type::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demandeRepository->add($demande);
            return $this->redirectToRoute('app_demande_avec_type_id_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demande_avec_type_id/new.html.twig', [
            'demande' => $demande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_avec_type_id_show', methods: ['GET'])]
    public function show(Demande $demande): Response
    {
        return $this->render('demande_avec_type_id/show.html.twig', [
            'demande' => $demande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_demande_avec_type_id_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Demande $demande, DemandeRepository $demandeRepository): Response
    {
        $form = $this->createForm(Demande2Type::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demandeRepository->add($demande);
            return $this->redirectToRoute('app_demande_avec_type_id_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demande_avec_type_id/edit.html.twig', [
            'demande' => $demande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_avec_type_id_delete', methods: ['POST'])]
    public function delete(Request $request, Demande $demande, DemandeRepository $demandeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demande->getId(), $request->request->get('_token'))) {
            $demandeRepository->remove($demande);
        }

        return $this->redirectToRoute('app_demande_avec_type_id_index', [], Response::HTTP_SEE_OTHER);
    }
}
