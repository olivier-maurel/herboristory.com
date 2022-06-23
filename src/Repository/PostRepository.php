<?php

namespace App\Repository;

use App\Entity\Plant;
use App\Entity\PlantAttribute;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Post $entity, bool $flush = false): void
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
    public function remove(Post $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Post[] Returns an array of Post objects
     */
    public function findBySearch($search, $category, $attributes)
    {
        $query = $this->createQueryBuilder('post')
            ->select('post')
            ->leftJoin('post.plant', 'plant')
        ;

        // Recherche par texte
        if ($search != '')
            $query
                // Search from plant
                ->where('plant.commonName LIKE :search')
                ->orWhere('plant.scientific_class LIKE :search')
                ->orWhere('plant.scientific_order LIKE :search')
                ->orWhere('plant.scientific_family LIKE :search')
                ->orWhere('plant.scientific_genus LIKE :search')
                ->orWhere('plant.scientific_species LIKE :search')
                // Search from post
                ->orWhere('post.title LIKE :search')
                ->orWhere('post.description LIKE :search')
                ->orWhere('post.keywords LIKE :search')

                ->setParameter('search', '%'.$search.'%')
            ;

        // Recherche par catégorie
        if ($category != '')
            $query 
                ->andWhere('plant.category LIKE :category')
                ->setParameter('category', '%'.$category.'%')
            ;
        if (!empty($attributes)) {
            $query
                ->innerJoin('plant.feature', 'feature')
                ->innerJoin('feature.attributes', 'attribute')
                ->andWhere('attribute.id IN(:attributes)')
                ->setParameter('attributes', $attributes)
            ;
        }

        return $query
            ->orderBy('post.id', 'ASC')
            ->getQuery()
            ->getResult() 
        ;
    }

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
