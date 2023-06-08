<?php

namespace App\Controller;

use App\Repository\WorkShopRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VentesController extends AbstractController
{
    private WorkShopRepository $workshoprepository;

    public function __construct(WorkShopRepository $workshoprepository)
    {
        $this->workshoprepository = $workshoprepository;
    }

    #[Route('/ventes', name: 'app_ventes')]
    public function index(
        ManagerRegistry $doctrine,
        PaginatorInterface $paginatorInterface,
        Request $request
    ): Response {
        $data = $this->workshoprepository->findBy(
            ['is_published' => true]
        );

        $ventes = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('ventes/index.html.twig', [
            'controller_name' => 'VentesController',
            'ventes' => $ventes
        ]);
    }
}