<?php

namespace App\Factory;

use App\Entity\Purchase;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\ShoppingCart;
use DateTime;

/**
 * Class OrderFactory
 * @package App\Factory
 */
class OrderFactory
{
    /**
     * Creates an order.
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
     * @return OrderItem
     */
    public function createItem(Product $product): OrderItem
    {
        $item = new OrderItem();
        $item->setProduct($product);
        $item->setQuantity(1);

        return $item;
    }
}
