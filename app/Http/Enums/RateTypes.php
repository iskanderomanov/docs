<?php

namespace App\Http\Enums;

enum RateTypes:string
{
    case MAIN = 'main';
    case ADDITIONAL = 'additional';
    case HIRED = 'hired';

    /**
     * @param string $val
     * @return string
     */
    public static function getRateTypeText(string $val): string
    {
        return match ($val) {
            self::MAIN->value => 'Штатная ставка',
            self::ADDITIONAL->value => 'Дополнительная ставка',
            self::HIRED->value => 'Наемная ставка',
        };
    }

    public static function getRateId(string $val): int
    {
        return match ($val) {
            self::MAIN->value => 1,
            self::ADDITIONAL->value => 2,
            self::HIRED->value => 3,
        };
    }
}
