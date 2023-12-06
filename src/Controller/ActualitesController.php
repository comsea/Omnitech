<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualitesController extends AbstractController
{
    private NewsRepository $newsrepository;

    public function __construct(NewsRepository $newsrepository)
    {
        $this->newsrepository = $newsrepository;
    }

    #[Route('/actualites', name: 'app_actualites')]
    public function index(
        ManagerRegistry $doctrine,
        PaginatorInterface $paginatorInterface,
        Request $request
    ): Response {
        $data = $this->newsrepository->findBy(
            ['is_published' => true]
        );

        $news = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('actualites/index.html.twig', [
            'controller_name' => 'ActualitesController',
            "news" => $news
        ]);
    }
}
