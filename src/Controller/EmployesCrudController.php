<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Form\EmployesType;
use App\Repository\EmployesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/employes/crud')]
class EmployesCrudController extends AbstractController
{
    #[Route('/', name: 'app_employes_crud_index', methods: ['GET'])]
    public function index(EmployesRepository $employesRepository): Response
    {
        return $this->render('employes_crud/index.html.twig', [
            'employes' => $employesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_employes_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EmployesRepository $employesRepository): Response
    {
        $employe = new Employes();
        $form = $this->createForm(EmployesType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employesRepository->add($employe);
            return $this->redirectToRoute('app_employes_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employes_crud/new.html.twig', [
            'employe' => $employe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employes_crud_show', methods: ['GET'])]
    public function show(Employes $employe): Response
    {
        return $this->render('employes_crud/show.html.twig', [
            'employe' => $employe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employes_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Employes $employe, EmployesRepository $employesRepository): Response
    {
        $form = $this->createForm(EmployesType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employesRepository->add($employe);
            return $this->redirectToRoute('app_employes_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employes_crud/edit.html.twig', [
            'employe' => $employe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employes_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Employes $employe, EmployesRepository $employesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employe->getId(), $request->request->get('_token'))) {
            $employesRepository->remove($employe);
        }

        return $this->redirectToRoute('app_employes_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
