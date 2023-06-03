<?php

declare(strict_types=1);

namespace App\Enum;

enum WeatherForecastSlotType: int
{
    case HOURLY     = 1;
    case DAY_PARTLY = 2;
    case DAILY      = 3;
}
