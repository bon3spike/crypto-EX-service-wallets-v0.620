<?php

declare(strict_types=1);

namespace App\Notification\Expander;

use App\Notification\Application\Dto\NotificationDto;

final readonly class NotificationDtoExpander implements NotificationDtoExpanderInterface
{
    /**
     * @param iterable<NotificationDtoExpanderInterface> $expanderCall
     */
    public function __construct(
        private iterable $expanderCall = []
    )
    {
    }

    public function expand(NotificationDto $dto, array $commandData): void
    {
        foreach ($this->expanderCall as $expander) {
            $expander->expand($dto, $commandData);
        }
    }
}

