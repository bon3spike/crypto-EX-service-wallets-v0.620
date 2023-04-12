<?php

namespace App\Notification\Application\Query\GetNotification;

use App\Application\Query\QueryInterface;

final readonly class GetNotificationQuery implements QueryInterface
{
    public function __construct(
        public string $_id,
        public string $text
    )
    {
    }
}