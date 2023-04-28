<?php

namespace App\Notification\Facade;

interface NotificationFacadeInterface
{
    public function lookupNotification(string $id): object;
}