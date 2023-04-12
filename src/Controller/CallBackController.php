<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Generator\Mail;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Email;


class CallBackController extends AbstractController
{
    private $doctrine;
    private $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager();
    }

    #[Route('/api/call_back/create', name: 'app_call_back_create', methods: ["POST"])]
    public function index(Request $request, Mail $mail): JsonResponse
    {

        $decoded = json_decode($request->getContent());
        $callback = new Ticket();
        # header
        $header = $decoded->header;
        $callback->setHeader($header);
        # контакты
        $contact = $decoded->contact;
        $callback->setContacts($contact);
        # текст
        $text  = $decoded->text;
        $callback->setText($text);

        # Gl
        $gl = $decoded->letter_of_guarantee_uri;
        $callback->setLetterOfGuaranteeUri($gl);
        # tech
        $datatime = new \DateTimeImmutable;
        $status_array = ['awaiting', 'compromised', 'wrong', 'actual'];  #FORTEST
        $callback->setStatus($status_array[mt_rand(0, 3)]);
        $callback->setCreatedAt($datatime);

        $orderInfo = $mail->decode($gl);
        $adress = $orderInfo->address_of_service;
        $callback->setRequest($adress);
        try {
            $this->em->persist($callback);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json($e->getMessage());
        }

        #check 
        $repository = $this->doctrine->getRepository(Ticket::class);

        $created_ticket = $repository->findBy(
            ['created_at' => $datatime],
        );
        $id = $created_ticket[0]->getId();



        return $this->json([
            'id' => $id,
        ]);
    }

    #[Route('/api/call_back/', name: 'app_call_back', methods: ["GET"])]
    public function callBackList(): JsonResponse
    {
        $data = [];

        $repository = $this->doctrine->getRepository(Ticket::class);
        $all = $repository->findAll();

        foreach ($all as $items) {
            $data[] = [
                "id" => $items->getId(),
                "header" => $items->getHeader(),
                "contact" => $items->getContacts(),
                "time" => $items->getCreatedAt(),
                "status" => $items->getStatus(),
            ];
        }
        return $this->json($data);
    }

    #[Route('/api/call_back/current', name: 'app_call_back_cur', methods: ["GET"])]
    public function callBackListID(Request $request, Mail $mail): JsonResponse
    {
        $id = $request->query->get('id');

        $repository = $this->doctrine->getRepository(Ticket::class);
        $current = $repository->findBy(
            ['id' => $id],
        );

        $orderInfo = $mail->check($current[0]->getLetterOfGuaranteeUri());
        if ($orderInfo === 1) {
            $orderInfo = true;
            $orderdata = $mail->decode($current[0]->getLetterOfGuaranteeUri());
            $order_id = $orderdata->id;
        } else {
            $orderInfo = false;
        }


        return $this->json([
            "id" => $current[0]->getId(),
            "order_id" => $order_id,
            "header" => $current[0]->getHeader(),
            "contact" => $current[0]->getContacts(),
            "time" => $current[0]->getCreatedAt(),
            "status" => $current[0]->getStatus(),
            "text" => $current[0]->getText(),
            "letter_of_guarantee_uri" => $current[0]->getLetterOfGuaranteeUri(),
            "request" => $current[0]->getRequest(), #после миксинга и обменов сделать сюда id заявки
            "real letter" => $orderInfo,
            "data" => $orderdata
        ]);
    }

    #[Route('/api/call_back/delete', name: 'app_call_back_dell', methods: ["DELETE"])]
    public function callBackListDel(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $id = $decoded->id;
        $product = $this->em->getRepository(Ticket::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Callback not found: id ' . $id
            );
        }

        try {
            $this->em->remove($product);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error:" => $e->getMessage()]);
        }

        return $this->json(["Callback request deleted" => $id]);
    }
}
