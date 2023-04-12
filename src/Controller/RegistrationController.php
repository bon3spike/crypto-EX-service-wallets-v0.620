<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Admin;

class RegistrationController extends AbstractController
{
    private $doctrine;
    private $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager();
    }

    #[Route('/api/register', name: 'app_registration', methods: ["POST"])]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $decoded = json_decode($request->getContent());
        $login = $decoded->login;
        $role = $decoded->role;
        $plaintextPassword = $decoded->password;
        $user = new Admin();
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setTemp($hashedPassword);
        $user->setPassword($hashedPassword);
        $user->setLogin($login);
        $user->setRoles([$role]);
        $user->setMessage("eFZOVzJrM04xbmdIN1NBM2tXQnpnTWc4eE9QaXY4ZDFldkxWZE9TQisxaz06OmzOLq1ZTdCOtUgCitwGGjg=");
        $this->em->persist($user);
        $this->em->flush();
        return $this->json(['message' => 'Registered Successfully']);
    }
}
