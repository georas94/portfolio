<?php

namespace App\Manager;

use App\Entity\Purchase;
use App\Entity\ShoppingCart;
use App\Factory\OrderFactory;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CartManager
 * @package App\Manager
 */
class CartManager
{
    /**
     * @var CartSessionStorage
     */
    private CartSessionStorage $cartSessionStorage;

    /**
     * @var OrderFactory
     */
    private OrderFactory $cartFactory;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManagerInterface;

    /**
     * CartManager constructor.
     *
     * @param CartSessionStorage $cartStorage
     * @param OrderFactory $orderFactory
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(CartSessionStorage $cartStorage, OrderFactory $orderFactory, EntityManagerInterface $entityManagerInterface) {
        $this->cartSessionStorage = $cartStorage;
        $this->cartFactory = $orderFactory;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * Gets the current cart.
     *
     * @return ShoppingCart
     */
    public function getCurrentCart(): ShoppingCart
    {
        $cart = $this->cartSessionStorage->getCart();

        if (!$cart) {
            $cart = $this->cartFactory->create();
        }

        return $cart;
    }

    /**
     * Persists the cart in database and session.
     *
     * @param Purchase $cart
     * @return bool
     */
    public function save(Purchase $cart): bool
    {
        // Persist in database
        try {
            $this->entityManagerInterface->persist($cart);
            $this->entityManagerInterface->flush();
            // Persist in session
            $this->cartSessionStorage->setCart($cart);

            return true;
        }catch (\Throwable $throwable){
            return false;
        }
    }
}
