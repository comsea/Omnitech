<?php

namespace App\Controller;

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

    public function __construct(WorkShopRepository $workshoprepository)
    {
        $this->workshoprepository = $workshoprepository;
    }

    #[Route('/ventes/occasion', name: 'app_occasion')]
    public function index(
        ManagerRegistry $doctrine,
        PaginatorInterface $paginatorInterface,
        Request $request
    ): Response {

        $data = $this->workshoprepository->findBy(
            ['is_published' => true, 'quality' => false],
        );

        $occasions = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('filter/occasion/index.html.twig', [
            'controller_name' => 'OccasionController',
            'occasions' => $occasions
        ]);
    }
}
