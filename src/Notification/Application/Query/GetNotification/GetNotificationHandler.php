<?php

namespace App\Notification\Application\Query\GetNotification;

use App\Notification\Application\Dto\NotificationDto;
use App\Repository\NotificationRepository;

final readonly class GetNotificationHandler
{
    public function __construct(private NotificationRepository $notificationRepository)
    {
    }
    public function __invoke(GetNotificationQuery $query) : NotificationDto
    {
        return $this->notificationRepository->findOneBy([]);
    }
}