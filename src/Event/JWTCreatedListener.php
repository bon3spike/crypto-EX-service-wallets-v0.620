<?php

namespace App\Event;

use App\Entity\Admin;
use Doctrine\Persistence\ManagerRegistry;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTAuthenticatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedListener
{
    private $requestStack;

    private $repository;
    private $em;
    
    public function __construct(RequestStack $requestStack, ManagerRegistry $doc)
    {
        $this->requestStack = $requestStack;
        $this->repository = $doc->getRepository(Admin::class);
        $this->em = $doc->getManager();
    }
    
    public function AuthenticationSuccess(JWTAuthenticatedEvent $event)
    {
        $user = $event->getPayload();
        
        
        $user = $this->repository->findOneBy(
            ["login" => $user['username']],
        );
        
        $pass = $user->getPassword();
        $user->setTemp($pass);
        $user->update("");
        $this->em->persist($user);
        $this->em->flush();
    

        // 
        // $this->doctrine->persist($user);
        // $this->doctrine->flush();

        
        // print($pass);
        
    }
}