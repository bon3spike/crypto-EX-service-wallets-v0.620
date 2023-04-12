<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Certificate;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class CertificateController extends AbstractController
{
    private $doctrine;
    private $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager();
    }

    #[Route('/api/certificate/get', name: 'app_certificate_get', methods: ["GET"])]
    public function getCertificate(): JsonResponse
    {
        $text = $this->em->getRepository(Certificate::class)->findOneBy([]);
        try {
            return $this->json([
                'text' => $text->getText(),
                'visible' => ($text->isVisible()),
            ]);
        } catch (\Exception $e) {
            return $this->json(["Error:" => $e->getMessage()]);
        }
    }

    #[Route('/api/certificate/changevisible', name: 'app_certificate_changevisible', methods: ["PATCH"])]
    public function changeVisibleCertificate(Request $request): JsonResponse
    {

        $decoded = json_decode($request->getContent());
        $changevisible = $decoded->changevisible;
        if ($changevisible == false) {
            $text = $this->em->getRepository(Certificate::class)->findOneBy([]);
            $text->setVisible(false);
            try {
                $this->em->persist($text);
                $this->em->flush();
                return $this->json([
                    'changed_visible' => $text->isVisible(),
                ]);
            } catch (\Exception $e) {
                return $this->json(["Error:" => $e->getMessage()]);
            }
        } elseif ($changevisible == true) {
            $text = $this->em->getRepository(Certificate::class)->findOneBy([]);
            $text->setVisible(true);
            try {
                $this->em->persist($text);
                $this->em->flush();
                return $this->json([
                    'changed_visible' => $text->isVisible(),
                ]);
            } catch (\Exception $e) {
                return $this->json(["Error:" => $e->getMessage()]);
            }
        }
    }

    #[Route('/api/certificate/changetext', name: 'app_certificate_changetext', methods: ["PATCH"])]
    public function changeTextCertificate(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $changetext = $decoded->changetext;
        if ($changetext == !null) {
            $text = $this->em->getRepository(Certificate::class)->findOneBy([]);
            $text->setText($changetext);
            try {
                $this->em->persist($text);
                $this->em->flush();
                return $this->json([
                    'changed_text' => $text->getText(),
                ]);
            } catch (\Exception $e) {
                return $this->json(["Error:" => $e->getMessage()]);
            }
        }
    }
}
