<?php

namespace App\Repository;

use App\Entity\OutputTransaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OutputTransaction>
 *
 * @method OutputTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method OutputTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method OutputTransaction[]    findAll()
 * @method OutputTransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OutputTransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OutputTransaction::class);
    }

    public function save(OutputTransaction $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OutputTransaction $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OutputTransaction[] Returns an array of OutputTransaction objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OutputTransaction
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
