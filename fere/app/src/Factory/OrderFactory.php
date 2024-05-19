<?php

namespace App\Factory;

use App\Entity\ShoppingCart;
use App\Entity\ShoppingCartItem;
use App\Entity\Product;
use DateTime;

/**
 * Class OrderFactory
 * @package App\Factory
 */
class OrderFactory
{
    /**
     * Creates a new cart.
     *
     * @return ShoppingCart
     */
    public function create(): ShoppingCart
    {
        $order = new ShoppingCart();
        $order
            ->setStatus(ShoppingCart::STATUS_CART)
            ->setCreatedAt(new DateTime())
            ->setUpdatedAt(new DateTime());

        return $order;
    }

    /**
     * Creates an item for a product.
     *
     * @param Product $product
     *
     * @return ShoppingCartItem
     */
    public function createItem(Product $product): ShoppingCartItem
    {
        $item = new ShoppingCartItem();
        $item->setProduct($product);
        $item->setQuantity(1);

        return $item;
    }
}
