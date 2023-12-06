<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualiteController extends AbstractController
{
    private NewsRepository $newsrepository;

    public function __construct(NewsRepository $newsrepository)
    {
        $this->newsrepository = $newsrepository;
    }

    #[Route('/actualite/{id}', name: 'app_actualite')]
    public function index(int $id): Response
    {
        $news = $this->newsrepository->find($id);

        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
            "news" => $news
        ]);
    }
}
