<?php

namespace App\Repository;

use App\Entity\PlantFeature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlantFeature>
 *
 * @method PlantFeature|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlantFeature|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlantFeature[]    findAll()
 * @method PlantFeature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlantFeatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlantFeature::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PlantFeature $entity, bool $flush = false): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(PlantFeature $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    /**
//     * @return PlantFeature[] Returns an array of PlantFeature objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlantFeature
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
