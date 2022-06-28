<?php
namespace App\Enum;


use MyCLabs\Enum\Enum;

/**
 * @method static static ADMIN()
 * @method static static SHOP()
 * @method static static COMPANY()
 */
class UsersType extends Enum
{
    private const ADMIN = 1;
    private const SHOP = 2;
    private const FINANCIAL_COMPANY = 3;

    public static function toTitlesArray(): array
    {
        return [
            self::ADMIN => 'Админ',
            self::SHOP => 'Магазин',
            self::FINANCIAL_COMPANY => 'Финансовая компания',
        ];
    }

    public function getTitle(): string
    {
        return self::toTitlesArray()[$this->getValue()];
    }
}
