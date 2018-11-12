<?php

namespace App\Mailer;

final class Emails
{
    public const CONTACT_REQUEST = 'contact_request';
    public const ORDER_CONFIRMATION = 'order_confirmation';
    public const SHIPMENT_CONFIRMATION = 'shipment_confirmation';
    public const USER_REGISTRATION = 'user_registration';

    private function __construct()
    {
    }
}
