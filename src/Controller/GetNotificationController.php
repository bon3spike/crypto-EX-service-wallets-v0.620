<?php

namespace App\Controller;

use App\Notification\Dto\NotificationDto;
use App\Notification\Expander\NotificationDtoExpander;
use App\Notification\Expander\NotificationDtoExpanderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class GetNotificationController extends AbstractController
{

    private NotificationDtoExpanderInterface $expander;

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

    #[Route('/api/notification/get_notification', name: 'app_get_notification', methods: ["GET"])]
    public function getNotification(): JsonResponse
    {
        return new JsonResponse($this->getDto(2));
    }
}
