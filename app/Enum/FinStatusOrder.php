<?php

namespace App\Enum;

use InvalidArgumentException;
use MyCLabs\Enum\Enum;


class FinStatusOrder extends Enum
{
    private const EXPECT = 'expect';
    private const ALLOWED = 'allowed';
    private const CANCELLED = 'cancelled';

    public static function toIdArray(): array
    {
        return [
            1 => self::EXPECT,
            2 => self::ALLOWED,
            3 => self::CANCELLED,
        ];
    }

    public static function fromId(int $id): ?self
    {
        $ids = self::toIdArray();

        return  (isset($ids[$id])) ? new self($ids[$id]) : null;
    }

    public function getId(): int
    {
        $id = array_search($this->getValue(), self::toIdArray(), true);

        if (false === $id) {
            throw new InvalidArgumentException('Unknown cash order type: ' . $this->getValue());
        }

        return $id;
    }

    public function getTitle(): string
    {
        $titles = self::toTitlesArray();

        return $titles[$this->getId()] ?? '';
    }

    public static function toTitlesArray(): array
    {
        return [
            1 => 'На расмотрении',
            2 => 'Одобрен',
            3 => 'Отклонен',
        ];
    }

}
