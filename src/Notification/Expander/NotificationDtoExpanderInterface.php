<?php

declare(strict_types=1);

namespace App\Notification\Expander;

use App\Notification\Application\Dto\NotificationDto;

interface NotificationDtoExpanderInterface
{
    public function expand(NotificationDto $dto, array $commandData): void;
}