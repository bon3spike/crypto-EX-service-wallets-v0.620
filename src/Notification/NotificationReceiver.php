<?php

namespace App\Notification;

use App\Notification\Dto\NotificationDto;
use App\Notification\Expander\NotificationDtoExpander;
use App\Notification\Expander\NotificationDtoExpanderInterface;
use App\Notification\Facade\NotificationFacadeInterface;

final class NotificationReceiver implements NotificationReceiverInterface
{
    public function __construct(NotificationDtoExpanderInterface $expander)
    {
        $this->expander = $expander;
    }
    public function getDto(string $id): object
    {
        $dto = new NotificationDto($id);
        $this->expander->expand($dto);
        return $dto;
    }
}