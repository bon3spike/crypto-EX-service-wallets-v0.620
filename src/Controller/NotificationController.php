<?php

namespace App\Controller;

use App\Entity\Notification;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    private $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager();
    }

    #[Route('/api/notification', name: 'app_notification', methods: ["PATCH"])]
    public function index(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $changetext = $decoded->changetext;
        $text = $this->em->getRepository(Notification::class)->findOneBy([]);
        $text->setText($changetext);
        try {
            $this->em->persist($text);
            $this->em->flush();
            return $this->json([
                'changed_text' => $text->getText(),
            ]);
        } catch (\Exception $e) {
            return $this->json(['Error, check the documentation and fix request' => $e->getMessage()]);
        }
    }

    #[Route('/api/notification/get', name: 'app_notification_get', methods: ["GET"])]
    public function getNoti(): JsonResponse
    {

        $text = $this->em->getRepository(Notification::class)->findOneBy([]);
        try {
            return $this->json([
                'text' => $text->getText(),
            ]);
        } catch (\Exception $e) {
            return $this->json(['Error, check the documentation and fix request' => $e->getMessage()]);
        }
    }
}
