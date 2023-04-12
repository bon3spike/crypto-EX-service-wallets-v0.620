<?php

namespace App\Repository;

use App\Entity\AddressMixing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AddressMixing>
 *
 * @method AddressMixing|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressMixing|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressMixing[]    findAll()
 * @method AddressMixing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressMixingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddressMixing::class);
    }

    public function save(AddressMixing $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AddressMixing $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AddressMixing[] Returns an array of AddressMixing objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AddressMixing
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
