<?php

namespace App\Controller;

use App\Entity\Results;
use App\Form\ResultsType;
use App\Repository\ResultsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/results")
 */
class ResultsController extends AbstractController
{
    /**
     * @Route("/", name="results_index", methods={"GET"})
     */
    public function index(ResultsRepository $resultsRepository): Response
    {
        return $this->render('results/index.html.twig', [
            'results' => $resultsRepository->findAll(),
        ]);
    }
}
