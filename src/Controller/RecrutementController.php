<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecrutementController extends AbstractController
{
    private JobRepository $jobrepository;

    public function __construct(JobRepository $jobrepository)
    {
        $this->jobrepository = $jobrepository;
    }

    #[Route('/recrutement', name: 'app_recrutement')]
    public function index(): Response
    {
        $jobs = $this->jobrepository->findBy(
            ['is_published' => true]
        );

        return $this->render('recrutement/index.html.twig', [
            'controller_name' => 'RecrutementController',
            "jobs" => $jobs
        ]);
    }
}
