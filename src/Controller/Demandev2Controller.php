<?php

namespace App\Controller;

use App\Entity\Demandev2;
use App\Form\Demandev2Type;
use App\Repository\Demandev2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/demandev2')]
class Demandev2Controller extends AbstractController
{
    #[Route('/', name: 'app_demandev2_index', methods: ['GET'])]
    public function index(Demandev2Repository $demandev2Repository): Response
    {
        return $this->render('demandev2/index.html.twig', [
            'demandev2s' => $demandev2Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_demandev2_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Demandev2Repository $demandev2Repository): Response
    {
        $demandev2 = new Demandev2();
        $form = $this->createForm(Demandev2Type::class, $demandev2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demandev2Repository->add($demandev2);
            return $this->redirectToRoute('app_demandev2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demandev2/new.html.twig', [
            'demandev2' => $demandev2,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demandev2_show', methods: ['GET'])]
    public function show(Demandev2 $demandev2): Response
    {
        return $this->render('demandev2/show.html.twig', [
            'demandev2' => $demandev2,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_demandev2_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Demandev2 $demandev2, Demandev2Repository $demandev2Repository): Response
    {
        $form = $this->createForm(Demandev2Type::class, $demandev2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demandev2Repository->add($demandev2);
            return $this->redirectToRoute('app_demandev2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demandev2/edit.html.twig', [
            'demandev2' => $demandev2,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demandev2_delete', methods: ['POST'])]
    public function delete(Request $request, Demandev2 $demandev2, Demandev2Repository $demandev2Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandev2->getId(), $request->request->get('_token'))) {
            $demandev2Repository->remove($demandev2);
        }

        return $this->redirectToRoute('app_demandev2_index', [], Response::HTTP_SEE_OTHER);
    }
}
