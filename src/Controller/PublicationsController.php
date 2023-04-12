<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Publication;

class PublicationsController extends AbstractController
{
    private $doctrine;
    private $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager();
    }

    #[Route('/api/publications', name: 'app_publications', methods: ["PATCH", "PUT", "DELETE", "POST"])]
    public function index(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $take = $decoded->take;
        $repository = $this->doctrine->getRepository(Publication::class);
        if ($take == "add") {
            $decoded = json_decode($request->getContent());
            $headline = $decoded->headline;
            $text = $decoded->text;
            $img = $decoded->img;
            $publicationadd = new Publication();
            $publicationadd->setHeadline($headline);
            $publicationadd->setText($text);
            $publicationadd->setImg($img);
            $date_publ = new \DateTime();
            $publicationadd->setCreatedAt($date_publ);
            try {
                $this->em->persist($publicationadd);
                $this->em->flush();
                return $this->json([
                    'status' => 'Publication created successfully',
                    'id' => $publicationadd->getId(),
                    'headline' => $publicationadd->getHeadline(),
                    'text' => $publicationadd->getText(),
                    'img' => $publicationadd->getImg(),
                    'created_at' => $publicationadd->getCreatedAt()->format('Y-m-d')

                ]);
            } catch (\Exception $e) {
                return $this->json(['Error, publication not created, check the documentation and fix request' => $e->getMessage()]);
            }
        } elseif ($take == "edit") {
            $pointer = $decoded->pointer;
            $selector = $decoded->selector;
            if ($pointer == "id") {
                $entity = $repository->findBy(
                    ["$pointer" => "$selector"]
                );
                if (!$entity) {
                    throw $this->createNotFoundException(
                        'Error, this publication not exist: id' . $selector
                    );
                }
                $change = $decoded->change;
                if (isset($change->headline)) {
                    $headline = $change->headline;
                    if ($headline !== '') {
                        $entity[0]->setHeadline($headline);
                        try {
                            $this->em->persist($entity[0]);
                            $this->em->flush();
                        } catch (\Exception $e) {
                            return $this->json(['Error, check the documentation and fix request' => $e->getMessage()]);
                        }
                    }
                }
                if (isset($change->text)) {
                    $text = $change->text;
                    if ($text !== '') {
                        $entity[0]->setText($text);
                        try {
                            $this->em->persist($entity[0]);
                            $this->em->flush();
                        } catch (\Exception $e) {
                            return $this->json(['Error, check the documentation and fix request' => $e->getMessage()]);
                        }
                    }
                }
                if (isset($change->img)) {
                    $img = $change->img;
                    if ($img !== '') {
                        $entity[0]->setImg($img);
                        try {
                            $this->em->persist($entity[0]);
                            $this->em->flush();
                        } catch (\Exception $e) {
                            return $this->json(['Error, check the documentation and fix request' => $e->getMessage()]);
                        }
                    }
                }

                return $this->json([
                    "headline" => $entity[0]->getHeadline(),
                    "text" => $entity[0]->getText(),
                    "img" => $entity[0]->getImg()

                ]);
            }
        } elseif ($take == "remove") {
            $pointer = $decoded->pointer;
            $selector = $decoded->selector;
            if ($pointer == "id") {
                $product = $this->em->getRepository(Publication::class)->find($selector);
                if (!$product) {
                    throw $this->createNotFoundException(
                        'Error, this publication not exist' . $selector
                    );
                }
                $this->em->remove($product);
                $this->em->flush();
                return $this->json("Publication deleted successfully");
            }
        }
        return $this->json('');
    }

    #[Route('/api/publications/take/', name: 'app_publications_take_add', methods: ["GET"])]
    public function takeAllPublications(Request $request): JsonResponse
    {
        $take = $request->query->get('take');
        if ($take === "all") {
            try {
                $repository = $this->doctrine->getRepository(Publication::class);
                $data = [];
                foreach ($repository->findAll() as $entity) {

                    $data[] = [
                        "id" => $entity->getId(),
                        'headline' => $entity->getHeadline(),
                        'text' => $entity->getText(),
                        'img' => $entity->getImg(),
                        'created_at' => $entity->getCreatedAt()->format('Y-m-d')


                    ];
                }
                return $this->json($data);
            } catch (\Exception $e) {
                return $this->json(['Error, publications not found' => $e->getMessage()]);
            }
        } elseif ($take === 'current') {
            $pointer = $request->query->get('pointer');
            $selector = $request->query->get('selector');
            $repository = $this->doctrine->getRepository(Publication::class);
            $data = [];
            $publications = $repository->findBy(
                ["$pointer" => "$selector"],
            ); {
                foreach ($publications as $publication) {
                    $data[] = [
                        "id" => $publication->getId(),
                        'headline' => $publication->getHeadline(),
                        'text' => $publication->getText(),
                        'img' => $publication->getImg(),
                        'created_at' => $publication->getCreatedAt()->format('Y-m-d')

                    ];
                }
            }
            if ($data === [] || $data === '') {
                return $this->json(['Error' => 'There are no publications with these values']);
            } else {
                return $this->json($data);
            }
        }
        return $this->json('');
    }
}
