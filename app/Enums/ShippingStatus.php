<?php

namespace App\Enums;

enum ShippingStatus: string
{
    case Pending = 'PENDING';
    case On_Shipping = 'ON_SHIPPING';
}
