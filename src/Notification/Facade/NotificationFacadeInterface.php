<?php

namespace App\Notification\Facade;

interface NotificationFacadeInterface
{
    public function getDto(string $id): mixed;
}