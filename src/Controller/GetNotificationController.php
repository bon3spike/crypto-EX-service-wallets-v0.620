<?php

namespace App\Controller;

use App\Notification\Dto\NotificationDto;
use App\Notification\Expander\NotificationDtoExpander;
use App\Notification\Expander\NotificationDtoExpanderInterface;
use App\Notification\Facade\NotificationFacadeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GetNotificationController extends AbstractController
{

    private NotificationFacadeInterface $facade;

    public function __construct(NotificationFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    #[Route('/api/notification/get_notification', name: 'app_get_notification', methods: ["GET"])]
    public function getNotification(): JsonResponse
    {
        return new JsonResponse($this->facade->getDto(1));
    }
}
