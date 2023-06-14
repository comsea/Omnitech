<?php

namespace App\Controller;

use App\Repository\ArticleCategoryRepository;
use App\Repository\WorkShopRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OccasionController extends AbstractController
{
    private WorkShopRepository $workshoprepository;
    private ArticleCategoryRepository $articlecategoryrepository;

    public function __construct(
        WorkShopRepository $workshoprepository,
        ArticleCategoryRepository $articlecategoryrepository
    ) {
        $this->workshoprepository = $workshoprepository;
        $this->articlecategoryrepository = $articlecategoryrepository;
    }

    #[Route('/ventes/occasion', name: 'app_occasion')]
    public function index(
        ManagerRegistry $doctrine,
        PaginatorInterface $paginatorInterface,
        Request $request
    ): Response {
        $articles = $this->articlecategoryrepository->findBy(
            ['is_active' => true]
        );

        $data = $this->workshoprepository->findBy(
            ['is_published' => true, 'quality' => false],
        );

        $occasions = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('filter_ventes/occasion/index.html.twig', [
            'controller_name' => 'OccasionController',
            'occasions' => $occasions,
            'articles' => $articles
        ]);
    }
}
