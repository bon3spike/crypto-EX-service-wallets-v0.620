<?php

declare(strict_types=1);

namespace App\Notification\Expander;

use App\Entity\Notification;
use App\Notification\Dto\NotificationDto;
use Doctrine\ORM\EntityManagerInterface;

final class  NotificationDtoTextExpander implements NotificationDtoExpanderInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function expand(NotificationDto $dto): void
    {
        $entity = $this->entityManager->getRepository(Notification::class)->findOneBy([]);
        $dto->text = $entity->getText();
    }
}