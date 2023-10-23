<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    private JobRepository $jobrepository;

    public function __construct(JobRepository $jobrepository)
    {
        $this->jobrepository = $jobrepository;
    }

    #[Route('/job/{id}', name: 'app_job')]
    public function index(int $id): Response
    {
        $jobs = $this->jobrepository->find($id);

        return $this->render('job/index.html.twig', [
            'controller_name' => 'JobController',
            "jobs" => $jobs
        ]);
    }
}
