<?php

namespace App\Notification;

interface NotificationReceiverInterface
{
    public function getDto(string $id): object;
}