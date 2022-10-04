<?php

namespace App\Services;

use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartServices
{
  private $session;
  private $productsRepository;
  public function __construct(SessionInterface $session, ProductsRepository $productsRepository)
  {
    $this->session = $session;
    $this->productsRepository = $productsRepository;
  }

  public function addToCart($id)
  {
    $cart = $this->getCart();
    if (isset($cart[$id])) {

      $cart[$id]++;
    } else {
      $cart[$id] = 1;
    }

    $this->updateCart($cart);
  }

  public function deleteFromCart($id)
  {
    $cart = $this->getCart();
    if (isset($cart[$id])) {
      if ($cart[$id] > 1) {
        $cart[$id]--;
      } else {
        unset($cart[$id]);
      }
      $this->updateCart($cart);
    }
  }

  public function deleteAllToCart($id)
  {
    $cart = $this->getCart();

    if (isset($cart[$id])) {
      unset($cart[$id]);
      $this->updateCart($cart);
    }
  }

  public function deleteCart()
  {
    $this->updateCart([]);
  }


  public function updateCart($cart)
  {
    $this->session->set('cart', $cart);
    $this->session->set('cartData', $this->getFullCart());
  }


  public function getCart()
  {
    return $this->session->get('cart', []);
  }



  public function getFullCart()
  {
    $cart = $this->getCart();
    $fullCart = [];
    foreach ($cart as $id => $quantity) {
      $product = $this->productsRepository->find($id);

      if ($product) {
        $fullCart[] = [
          "quantity" => $quantity,
          "product" => $product,
        ];
      } else {
        $this->deleteFromCart($id);
      }
    }
    return $fullCart;
  }
}
