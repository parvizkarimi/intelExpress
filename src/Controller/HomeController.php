<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  #[Route('/', name: 'app_home')]
  public function index(ProductsRepository $productsRepository): Response
  {
    $productsBestSeller = $productsRepository->findByIsBestSeller(1);
    $productsSpecialOffer = $productsRepository->findByIsSpecialOffer(1);
    $productsNewArrival = $productsRepository->findByIsNewArrival(1);
    $productsFeatured = $productsRepository->findByIsFeatured(1);

    return $this->render('home/index.html.twig', [
      'products' => $productsRepository->findAll(),

      'productsBestSeller' => $productsBestSeller,
      'productsSpecialOffer' => $productsSpecialOffer,
      'productsNewArrival' => $productsNewArrival,
      'productsFeatured' => $productsFeatured,
    ]);
  }


  #[Route('/product/{slug}', name: 'app_product_show')]
  public function show(?Products $product): Response
  {
    if (!$product) {
      return $this->redirectToRoute('app_home');
    }

    return $this->render('home/show.html.twig', [
      'product' => $product,
    ]);
  }
}
