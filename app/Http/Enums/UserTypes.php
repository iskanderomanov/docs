<?php

namespace App\Http\Enums;

enum UserTypes: int
{
    case HR_TYPE = 1;
    case ACCOUNTING_TYPE = 2;
    case TEACHER_TYPE = 3;

    /**
     * @param int $val
     * @return string
     */
    public static function getUserTypeText(int $val): string
    {
        return match ($val) {
            self::HR_TYPE->value => 'Отдел кадров',
            self::ACCOUNTING_TYPE->value => 'Бухгалтерия',
            self::TEACHER_TYPE->value => 'Преподователь'
        };
    }
}
