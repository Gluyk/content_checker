<?php

namespace App\Controller;

use App\Entity\PageToCheck;
use App\Form\PageToCheckType;
use App\Repository\PageToCheckRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\GetContent;

/**
 * @Route("/page-to-check")
 */
class PageToCheckController extends AbstractController
{

    /**
     * @var \App\Service\GetContent
     */
    private GetContent $getContent;

    public function __construct(GetContent $getContent)
    {
        $this->getContent = $getContent;
    }

    /**
     * @Route("/", name="page_to_check_index", methods={"GET"})
     */
    public function index(PageToCheckRepository $pageToCheckRepository): Response
    {
        return $this->render('page_to_check/index.html.twig', [
            'page_to_checks' => $pageToCheckRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="page_to_check_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pageToCheck = new PageToCheck();
        $form = $this->createForm(PageToCheckType::class, $pageToCheck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nextAction = $form->get('check')->isClicked()
                ? 'check'
                : 'save';

            if ($nextAction === 'check') {
                $formData = $form->getData();
                $results = $this->getContent->get($formData->getUrl(), $formData->getFilter());

                return $this->render('page_to_check/new.html.twig', [
                    'page_to_check' => $pageToCheck,
                    'form' => $form->createView(),
                    'results' => $results,
                ]);
            } else {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($pageToCheck);
                $entityManager->flush();

                return $this->redirectToRoute('page_to_check_index');
            }
        }

        return $this->render('page_to_check/new.html.twig', [
            'page_to_check' => $pageToCheck,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="page_to_check_show", methods={"GET"})
     */
    public function show(PageToCheck $pageToCheck): Response
    {
        return $this->render('page_to_check/show.html.twig', [
            'page_to_check' => $pageToCheck,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="page_to_check_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PageToCheck $pageToCheck): Response
    {
        $form = $this->createForm(PageToCheckType::class, $pageToCheck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $nextAction = $form->get('check')->isClicked()
                ? 'check'
                : 'save';

            if ($nextAction === 'check') {
                $results = $this->getContent->get($formData->getUrl(), $formData->getFilter());

                return $this->render('page_to_check/edit.html.twig', [
                    'page_to_check' => $pageToCheck,
                    'form' => $form->createView(),
                    'results' => $results,
                ]);
            } elseif($nextAction === 'save') {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($formData);
                $entityManager->flush();

                return $this->redirectToRoute('page_to_check_index');
            }
        }

        return $this->render('page_to_check/edit.html.twig', [
            'page_to_check' => $pageToCheck,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="page_to_check_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PageToCheck $pageToCheck): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pageToCheck->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pageToCheck);
            $entityManager->flush();
        }

        return $this->redirectToRoute('page_to_check_index');
    }
}
