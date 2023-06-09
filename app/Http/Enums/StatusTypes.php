<?php

namespace App\Http\Enums;

enum StatusTypes: int
{
    /**
     * Ожидает проверки Отдела кадров
     */
    case AWAITING_VERIFICATION_HR = 1;
    /**
     * Отдел кадров не принял
     */
    case ERROR_FROM_HR = 2;
    /**
     * Ожидает проверки Бухгалтерии
     */
    case AWAITING_VERIFICATION_ACCOUNTING = 3;
    /**
     * Бухгалтерия не приняла
     */
    case ERROR_FROM_ACCOUNTING = 4;
    /**
     * Успешно
     */
    case SUCCESS = 5;

    /**
     * @param int $val
     * @return string
     */
    public static function getStatusText(int $val): string
    {
        return match ($val) {
            self::AWAITING_VERIFICATION_HR->value => 'Ожидает проверки ОК',
            self::ERROR_FROM_HR->value => 'Не прошла проверку ОК',
            self::AWAITING_VERIFICATION_ACCOUNTING->value => 'Ожидает проверки Бухгалтерии',
            self::ERROR_FROM_ACCOUNTING->value => 'Не прошла проверку Бухгалтерии',
            self::SUCCESS->value => 'Успешно'
        };
    }

    /**
     * @return array
     */
    public static function getStatusesText(): array
    {
        return [
            self::AWAITING_VERIFICATION_HR->value => 'Ожидает проверки ОК',
            self::ERROR_FROM_HR->value => 'Не прошла проверку ОК',
            self::AWAITING_VERIFICATION_ACCOUNTING->value => 'Ожидает проверки Бухгалтерии',
            self::ERROR_FROM_ACCOUNTING->value => 'Не прошла проверку Бухгалтерии',
            self::SUCCESS->value => 'Успешно'
        ];
    }

    /**
     * @param int $val
     * @return string
     */
    public static function getStatusCSSClass(int $val): string
    {
        return match ($val) {
            self::AWAITING_VERIFICATION_HR->value, self::AWAITING_VERIFICATION_ACCOUNTING->value => 'bg-yellow',
            self::ERROR_FROM_HR->value, self::ERROR_FROM_ACCOUNTING->value => 'bg-red',
            self::SUCCESS->value => 'bg-green'
        };
    }
}
