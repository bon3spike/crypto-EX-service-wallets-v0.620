<?php

declare(strict_types=1);

namespace App\Notification\Application\Dto;

use App\Entity\Notification;

final readonly class NotificationDto {
    public function __construct(
        public string|null $id,
        public string|null $text,
    )
    {
    }

    #создание DTO из сущности, getId не уникален, пока что оставил так
    public static function fromEntity(Notification $notification): self
    {
        return new self($notification->getId(), $notification->getText());
    }
}