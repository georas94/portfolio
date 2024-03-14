<?php

namespace App\Controller;

use App\Entity\ShoppingCartItem;
use App\Form\CartType;
use App\Manager\CartManager;
use App\Repository\AddressRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use App\Service\WhatsAppService;
use DateTime;
use Exception;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Throwable;

class CartController extends AbstractController
{
    public function __construct(private ProductRepository $productRepository, private AddressRepository $addressRepository, private WhatsAppService $whatsAppService, private UserRepository $userRepository, private CartManager $cartManager)
    {
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
     * @throws Exception
     */
    #[Route('/cart/checkout/shipping', name: 'app_cart_checkout')]
    public function cartShipping(CartManager $cartManager): Response
    {
        $user = $this->getUser();
        if(!$user){
            throw new Exception('Vous devez être connecté afin d\'accéder à cette page');
        }

        $cart = $cartManager->getCurrentCart();

        return $this->render('cart/checkout/shipping.html.twig', [
            'cart' => $cart,
            'user' => $user
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
        if (!$product) {
            throw new LogicException('Product not found', 404);
        }
        if (!$quantity) {
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
            if ($this->cartManager->save($cart)) {
                return $this->json([
                    'cart' => $cart,
                    'quantity' => $quantity,
                    Response::HTTP_OK
                ]);
            } else {
                throw new Exception('Error when saving cart');
            }
        } catch (\Throwable $throwable) {
            return $this->json([
                'erreur' => $throwable->getMessage(),
                'code' => $throwable->getCode()
            ]);
        }
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    #[Route('/cart/checkout/ask-location', name: 'app_ask_location')]
    public function askLocation(Request $request): JsonResponse
    {
        $idUtilisateur = $request->query->get('idUtilisateur');
        if(!$idUtilisateur){
            throw new Exception('Le paramètre idUtilisateur n\'a pas été fourni');
        }

        $user = $this->userRepository->findOneBy(['id' => $idUtilisateur]);
        $userPhoneNumber = $user->getPhoneNumber();
        $response = $this->whatsAppService->postMessage('Bonjour, merci de nous partager une position. FERE', $userPhoneNumber);
        return $this->json(
            [
                'statusCode' => (int)$response['statusCode'],
                $response
            ]
        );
    }

    #[Route('/cart/checkout/validate-location', name: 'app_validate_location')]
    public function validateLocation(Request $request): JsonResponse
    {
        try{
            $idUtilisateur = $request->query->get('idUtilisateur');
            if(!$idUtilisateur){
                throw new Exception('Le paramètre idUtilisateur n\'a pas été fourni');
            }

            $user = $this->userRepository->findOneBy(['id' => $idUtilisateur]);
            if(!$user){
                throw new Exception('Aucun utilisateur n\' a été trouvé en base de données avec l\'identifiant fourni');
            }
            $address = $this->addressRepository->findOneBy(['user' => $user], ['created_at' => 'DESC']);
            $latitude = $address->getLatitude();
            $longitude = $address->getLongitude();
            return $this->json(
                [
                    'statusCode' => 200,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                ]
            );
        } catch(Throwable $exception){
            return $this->json(
                [
                    'statusCode' => $exception->getCode(),
                    'exceptionMessage' => $exception->getMessage(),
                    'latitude' => null,
                    'longitude' => null,
                ],
                $exception->getCode()
            );
        }
    }
}
