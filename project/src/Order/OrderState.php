<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Order;

/**
 * Class OrderState
 */
class OrderState
{
    public const CART_STATE = 'cart';
    public const READY_FOR_PAYMENT = 'wait_payment';
    public const PAID = 'paid';
}
