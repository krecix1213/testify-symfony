<?php

namespace App\Repository;

use App\Entity\MultiAnswerCorrect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MultiAnswerCorrect>
 *
 * @method MultiAnswerCorrect|null find($id, $lockMode = null, $lockVersion = null)
 * @method MultiAnswerCorrect|null findOneBy(array $criteria, array $orderBy = null)
 * @method MultiAnswerCorrect[]    findAll()
 * @method MultiAnswerCorrect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MultiAnswerCorrectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MultiAnswerCorrect::class);
    }

    public function add(MultiAnswerCorrect $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MultiAnswerCorrect $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MultiAnswerCorrect[] Returns an array of MultiAnswerCorrect objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MultiAnswerCorrect
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
