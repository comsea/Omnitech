<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use App\Repository\WorkShopRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private NewsRepository $newsrepository;
    private WorkShopRepository $workshoprepository;

    public function __construct(NewsRepository $newsrepository, WorkShopRepository $workshoprepository)
    {
        $this->newsrepository = $newsrepository;
        $this->workshoprepository = $workshoprepository;
    }

    #[Route('/', name: 'app_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $news = $this->newsrepository->findAll();
        $ventes = $this->workshoprepository->findAll();

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            "news" => $news,
            'ventes' => $ventes
        ]);
    }
}
