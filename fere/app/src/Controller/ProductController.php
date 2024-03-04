<?php

namespace App\Controller;

use App\Entity\ProductCategory;
use App\Entity\ShoppingCartItem;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use DateTime;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductRepository $productRepository;
    private ProductCategoryRepository $productCategoryRepository;
    private CartManager $cartManager;
    public function __construct(ProductRepository $productRepository,ProductCategoryRepository $productCategoryRepository, CartManager $cartManager)
    {
        $this->productRepository = $productRepository;
        $this->productCategoryRepository = $productCategoryRepository;
        $this->cartManager = $cartManager;
    }

    #[Route('/products/{gender}/{category}', name: 'app_products')]
    public function index(string $gender, string $category): Response
    {
        if (!$gender || !$category){
            throw new LogicException('Aucun paramètre envoyé dans la requête');
        }
        $productCategory = $this->productCategoryRepository->findOneBy([
            'name' => $category
        ]);

        if ($gender === 'all' && $category === 'all'){
            $products = $this->productRepository->findAll();
        }else {
            $products = $this->productRepository->findBy(
                [
                    'gender' => $gender,
                    'category' => $productCategory,
                ]
            );
        }

        return $this->render('product/product_list.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @throws LogicException
     */
    #[Route('/products/{id}', name: 'app_product_view')]
    public function view(int $id, Request $request): Response
    {
        $product = $this->productRepository->find($id);
        if (!$product){
            throw new LogicException('Produit non existant');
        }

        $form = $this->createForm(AddToCartType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $item->setProduct($product);

            $cart = $this->cartManager->getCurrentCart();
            $cart
                ->addItem($item)
                ->setUpdatedAt(new DateTime());

            $this->cartManager->save($cart);

            return $this->redirectToRoute('app_product_view',
                [
                    'id' => $product->getId()
                ],
            Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('product/product_view.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }

    /**
     * @throws LogicException
     */
    #[Route('/products/{id}/add-to-cart', name: 'app_product_add_to_cart')]
    public function addToCart(int $id, Request $request): JsonResponse
    {
        $product = $this->productRepository->find($id);
        $quantity = $request->request->get('quantity');
        if (!$product){
            throw new LogicException('Produit non existant');
        }
        if (!$quantity){
            throw new LogicException('Quantité non fournie');
        }

        $cart = $this->cartManager->getCurrentCart();

        try {
            $orderItem = new ShoppingCartItem();
            $orderItem->setProduct($product);
            $orderItem->setQuantity($quantity);
            $orderItem->setOrderRef($cart);
            $cart->addItem($orderItem);
            $cart->setUpdatedAt(new DateTime());
            if ($this->cartManager->save($cart)){
                return $this->json([
                    'OK ! Retournés' => [
                        $cart
                    ],
                    Response::HTTP_OK
                ]);
            }
        }catch (\Throwable $throwable){
            return $this->json([
               'erreur' => $throwable->getMessage(),
               'code' => $throwable->getCode()
            ]);
        }

        return $this->json([
            'retournés' => [
                $request->request->get('quantity')
            ],
            Response::HTTP_OK
        ]);
    }
}
