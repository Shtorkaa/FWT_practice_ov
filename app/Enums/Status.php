<?php

namespace App\Enums;

enum Status: string
{
    case Active = 'active';
    case Complete = 'complete';
    case Failed = 'failed';
}
