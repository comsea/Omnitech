<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    private ProductRepository $productrepository;

    public function __construct(ProductRepository $productrepository)
    {
        $this->productrepository = $productrepository;
    }

    #[Route('/produit/{id}', name: 'app_produit')]
    public function index(int $id): Response
    {
        $produits = $this->productrepository->find($id);

        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
            'produits' => $produits
        ]);
    }
}
