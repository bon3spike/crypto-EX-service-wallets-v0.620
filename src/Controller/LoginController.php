<?php

namespace App\Controller;

use App\Handler\MessageHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/api/message_login', name: 'app_message', methods: ["POST"])]
    public function messageLogin(Request $request, MessageHandler $messageHandler): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $login = $decoded->login;
        $password = $decoded->password;

        $message = $messageHandler->getMessage($login, $password);


        return $this->json([
            'message' => $message,
        ]);
    }

    #[Route('/api/message_check', name: 'app_message_check', methods: ["POST"])]
    public function messageCheck(Request $request, MessageHandler $messageHandler): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $login = $decoded->login;
        $password = $decoded->password;
        $encoded = $decoded->encoded;

        $user = $messageHandler->checkMessage($login, $password, $encoded);


        return $this->json([
            'message' => $user,
        ]);
    }
}
