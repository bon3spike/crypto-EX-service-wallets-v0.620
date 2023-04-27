<?php

declare(strict_types=1);

namespace App\Notification\Expander;

use App\Notification\Dto\NotificationDto;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

final readonly class NotificationDtoExpander implements NotificationDtoExpanderInterface
{
    /** NotificationDtoExpanderInterface[] */

    public function __construct(
        #[TaggedIterator('app.notification_expander')]
        private iterable $expanders)
    {
    }

    public function expand(NotificationDto $dto): void
    {
        foreach ($this->expanders as $expander) {
            $expander->expand($dto);
        }
    }
}