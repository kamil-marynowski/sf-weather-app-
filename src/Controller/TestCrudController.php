<?php

namespace App\Controller;

use App\Entity\Test;
use App\Form\TestType;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test/crud')]
class TestCrudController extends AbstractController
{
    #[Route('/', name: 'app_test_crud_index', methods: ['GET'])]
    public function index(TestRepository $testRepository): Response
    {
        return $this->render('test_crud/index.html.twig', [
            'tests' => $testRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_test_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TestRepository $testRepository): Response
    {
        $test = new Test();
        $form = $this->createForm(TestType::class, $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testRepository->save($test, true);

            return $this->redirectToRoute('app_test_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('test_crud/new.html.twig', [
            'test' => $test,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_test_crud_show', methods: ['GET'])]
    public function show(Test $test): Response
    {
        return $this->render('test_crud/show.html.twig', [
            'test' => $test,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_test_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Test $test, TestRepository $testRepository): Response
    {
        $form = $this->createForm(TestType::class, $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testRepository->save($test, true);

            return $this->redirectToRoute('app_test_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('test_crud/edit.html.twig', [
            'test' => $test,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_test_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Test $test, TestRepository $testRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$test->getId(), $request->request->get('_token'))) {
            $testRepository->remove($test, true);
        }

        return $this->redirectToRoute('app_test_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
