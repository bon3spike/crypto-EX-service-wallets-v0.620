<?php

namespace App\Controller;

use App\Entity\Admin;
use Doctrine\Persistence\ManagerRegistry;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


/**
 * @Route("/api", name="api_")
 */

class DashboardController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    private TokenStorageInterface $tokenStorageInterface;
    private JWTTokenManagerInterface $jwtManager;
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(TokenStorageInterface $tokenStorageInterface, JWTTokenManagerInterface $jwtManager): JsonResponse
    {
        $this->jwtManager = $jwtManager;
        $this->tokenStorageInterface = $tokenStorageInterface;
        $decodedJwtToken = json_encode($this->jwtManager->decode($this->tokenStorageInterface->getToken()));
        $tokenData = json_decode($decodedJwtToken, true);
        $repository = $this->doctrine->getRepository(Admin::class);
        $admin_data = $repository->findBy(
            ['login' => $tokenData['username']],
        );


        return $this->json(
            [
                "login" => $tokenData['username'],
                "role" => $tokenData['roles'],
                "exp_time" => $tokenData['exp'],
                "secret_message" => $admin_data[0]->getMessage()
            ]
        );
    }
}
