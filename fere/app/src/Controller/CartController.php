<?php

namespace App\Controller;

use App\Entity\ShoppingCartItem;
use App\Form\CartType;
use App\Manager\CartManager;
use App\Repository\ProductRepository;
use DateTime;
use Exception;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private ProductRepository $productRepository;
    private CartManager $cartManager;
    public function __construct(ProductRepository $productRepository, CartManager $cartManager)
    {
        $this->productRepository = $productRepository;
        $this->cartManager = $cartManager;
    }

    #[Route('/cart', name: 'app_cart')]
    public function index(CartManager $cartManager, Request $request): Response
    {
        $cart = $cartManager->getCurrentCart();
        $form = $this->createForm(CartType::class, $cart);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart->setUpdatedAt(new \DateTime());
            $cartManager->save($cart);

            return $this->redirectToRoute('app_cart');
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @throws LogicException
     */
    #[Route('/cart/product/{id}/add-to-cart', name: 'app_product_add_to_cart')]
    public function addToCart(int $id, Request $request): JsonResponse
    {
        $product = $this->productRepository->find($id);
        $quantity = $request->get('quantity');
        if (!$product){
            throw new LogicException('Product not found', 404);
        }
        if (!$quantity){
            throw new LogicException('Quantity not provided', 400);
        }

        $cart = $this->cartManager->getCurrentCart();
        try {
            $orderItem = new ShoppingCartItem();
            $orderItem->setProduct($product);
            $orderItem->setQuantity((int)$quantity);
            $orderItem->setOrderRef($cart);
            $cart->addItem($orderItem);
            $cart->setUpdatedAt(new DateTime());
            if ($this->cartManager->save($cart)){
                return $this->json([
                    'cart' => $cart,
                    'quantity' => $quantity,
                    Response::HTTP_OK
                ]);
            }else {
                throw new Exception('Error when saving cart');
            }
        }catch (\Throwable $throwable){
            return $this->json([
                'erreur' => $throwable->getMessage(),
                'code' => $throwable->getCode()
            ]);
        }
    }
}
