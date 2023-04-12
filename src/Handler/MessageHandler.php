<?php
// src/Handler/MessageHandler.php
namespace App\Handler;

use App\Entity\Admin;
use App\Generator\Crypt;
use App\Generator\Mail;
use Doctrine\Persistence\ManagerRegistry;


class MessageHandler
{      
    private $doctrine;
    private $em;

    private $mail;

    private $crypt;

    public function __construct(ManagerRegistry $doctrine, Mail $mail, Crypt $crypt)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager();
        $this->mail = $mail;
        $this->crypt = $crypt;

    }

    private function getUser($login){
        $repository = $this->doctrine->getRepository(Admin::class);
        $admin_data = $repository->findOneBy(
            ['login' => $login],
        );
        return $admin_data;
    }

    public function getMessage($login, $password)
    {

        $admin_data = $this->getUser($login);
        $hashed_password = $admin_data->getTemp();
        $passwordcheck = password_verify($password, $hashed_password);
       

        if($passwordcheck === true){
        try{
            $admin_data->setMessage($this->crypt->encrypt($this->mail->rand(50)));
            $this->em->persist($admin_data);
            $this->em->flush();

            return $admin_data->getMessage();
        }catch (\Exception $e) {
            return ["Ошибка:" => $e->getMessage()];
        }
        
        }

        return "unknow error";
    }

    public function checkMessage($login, $password, $encoded){


        $admin_data = $this->getUser($login);
        $hashed_password = $admin_data->getTemp();
        $passwordcheck = password_verify($password, $hashed_password);
       

        if($passwordcheck === true){
           if($encoded === $this->crypt->decrypt($admin_data->getMessage()));{
             try{
                $admin_data->update($hashed_password);
                $admin_data->setTemp("");
                $this->em->persist($admin_data);
                $this->em->flush();

            return  "access accepted";
                }catch (\Exception $e) {
                    return ["Ошибка:" => $e->getMessage()];
                }

           }
        
       
    }
    return  "неверный пароль";
}
}
