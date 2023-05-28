<?php

namespace App\Http\Enums;

enum UserTypes: int
{
    case HR_TYPE = 1;
    case TIME_KEEPER_TYPE = 2;
    case ACCOUNTING_TYPE = 3;
    case TEACHER_TYPE = 4;

    /**
     * @param int $val
     * @return string
     */
    public static function getUserTypeText(int $val): string
    {
        return match ($val) {
            self::HR_TYPE->value => 'Отдел кадров',
            self::ACCOUNTING_TYPE->value => 'Бухгалтерия',
            self::TIME_KEEPER_TYPE->value => 'Табельщик',
            self::TEACHER_TYPE->value => 'Преподователь'
        };
    }
}
