<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductSubCategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductSupplierRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    private ProductCategoryRepository $productcategoryrepository;
    private ProductSubCategoryRepository $productsubcategoryrepository;
    private ProductRepository $productrepositorty;
    private ProductSupplierRepository $productsupplierrepositorty;

    public function __construct(
        ProductCategoryRepository $productcategoryrepository,
        ProductRepository $productrepositorty,
        ProductSubCategoryRepository $productsubcategoryrepository,
        ProductSupplierRepository $productsupplierrepositorty
    ) {
        $this->productcategoryrepository = $productcategoryrepository;
        $this->productrepositorty = $productrepositorty;
        $this->productsubcategoryrepository = $productsubcategoryrepository;
        $this->productsupplierrepositorty = $productsupplierrepositorty;
    }

    #[Route('/produits', name: 'app_produits')]
    public function index(): Response
    {
        $productcategorys = $this->productcategoryrepository->findBy(
            ['is_active' => true]
        );

        $productsubcategorys = $this->productsubcategoryrepository->findBy(
            ['is_active' => true]
        );


        $products = $this->productrepositorty->findBy(
            ['is_published' => true]
        );

        $suppliers = $this->productsupplierrepositorty->findBy(
            ['is_active' => true]
        );

        return $this->render('produits/index.html.twig', [
            'controller_name' => 'ProduitsController',
            'productcategorys' => $productcategorys,
            'products' => $products,
            'productsubcategorys' => $productsubcategorys,
            'suppliers' => $suppliers
        ]);
    }
}
