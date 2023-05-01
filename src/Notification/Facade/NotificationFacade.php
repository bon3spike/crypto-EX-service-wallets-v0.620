<?php

namespace App\Notification\Facade;


use App\Shared\Notification\NotificationReceiverInterface;

final readonly class NotificationFacade implements NotificationFacadeInterface
{
    public function __construct(
        private NotificationReceiverInterface $notificationReceiver)
    {
    }

    public function lookupNotification(string $id): object
    {
        return $this->notificationReceiver->getDto($id);
    }
}
