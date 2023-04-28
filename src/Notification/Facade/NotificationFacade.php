<?php

namespace App\Notification\Facade;

use App\Notification\Dto\NotificationDto;
use App\Notification\Expander\NotificationDtoExpanderInterface;

final class NotificationFacade implements NotificationFacadeInterface
{
    private NotificationDtoExpanderInterface $expander;

    public function __construct(NotificationDtoExpanderInterface $expander)
    {
        $this->expander = $expander;
    }

    public function getDto(string $id): mixed
    {
        $dto = new NotificationDto($id);
        $this->expander->expand($dto);
        return $dto;
    }
}