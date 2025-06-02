<?php

namespace App\Http\Enums;

enum OrderStatus: string
{
    case CREATED = 'created';
    case ASSIGNED = 'assigned';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match($this) {
            self::CREATED => 'Создан',
            self::ASSIGNED => 'Назначен исполнитель',
            self::COMPLETED => 'Завершен',
        };
    }
}
