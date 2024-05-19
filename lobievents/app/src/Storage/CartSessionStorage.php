<?php

namespace App\Storage;

use App\Entity\ShoppingCart;
use App\Repository\ShoppingCartRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartSessionStorage
{
    /**
     * The request stack.
     *
     * @var RequestStack
     */
    private RequestStack $requestStack;

    /**
     * The cart repository.
     *
     * @var ShoppingCartRepository
     */
    private ShoppingCartRepository $cartRepository;

    /**
     * @var string
     */
    private const CART_KEY_NAME = 'cart_id';

    /**
     * CartSessionStorage constructor.
     *
     * @param RequestStack $requestStack
     * @param ShoppingCartRepository $cartRepository
     */
    public function __construct(RequestStack $requestStack, ShoppingCartRepository $cartRepository)
    {
        $this->requestStack = $requestStack;
        $this->cartRepository = $cartRepository;
    }

    /**
     * Gets the cart in session.
     *
     * @return ShoppingCart|null
     */
    public function getCart(): ?ShoppingCart
    {
        return $this->cartRepository->findOneBy([
            'id' => $this->getCartId(),
            'status' => ShoppingCart::STATUS_CART
        ]);
    }

    /**
     * Sets the cart in session.
     *
     * @param ShoppingCart $cart
     */
    public function setCart(ShoppingCart $cart): void
    {
        $this->getSession()->set(self::CART_KEY_NAME, $cart->getId());
    }

    /**
     * Returns the cart id.
     *
     * @return int|null
     */
    private function getCartId(): ?int
    {
        return $this->getSession()->get(self::CART_KEY_NAME);
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }

}
