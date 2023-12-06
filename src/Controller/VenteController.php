<?php

namespace App\Controller;

use App\Repository\WorkShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VenteController extends AbstractController
{
    private WorkShopRepository $workshoprepository;

    public function __construct(WorkShopRepository $workshoprepository)
    {
        $this->workshoprepository = $workshoprepository;
    }

    #[Route('/vente/{id}', name: 'app_vente')]
    public function index(int $id): Response
    {
        $ventes = $this->workshoprepository->find($id);

        return $this->render('vente/index.html.twig', [
            'controller_name' => 'VenteController',
            'ventes' => $ventes
        ]);
    }
}
