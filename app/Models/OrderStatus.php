<?php

namespace App\Models;

enum OrderStatus : string
{
    case Ongoing = "ongoing";
    case Paid = "paid";
}
