<?php

declare(strict_types=1);

namespace App\Notification\Expander;

use App\Notification\Dto\NotificationDto;

interface NotificationDtoExpanderInterface
{
    public function expand(NotificationDto $dto): void;
}