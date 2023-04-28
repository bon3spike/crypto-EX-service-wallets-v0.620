<?php

declare(strict_types=1);

namespace App\Notification\Dto;

final class NotificationDto {
    public function __construct(
        public string|null $text = ''
    )
    {
    }

}