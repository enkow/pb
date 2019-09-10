<?php

namespace App\Repository;

use App\Entity\PostMark;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PostMark|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostMark|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostMark[]    findAll()
 * @method PostMark[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostMarkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PostMark::class);
    }
    public function queryAll():QueryBuilder
    {
        return $this->getOrCreateQueryBuilder();
    }
    /**
     * Get or create new query builder.
     *
     * @param \Doctrine\ORM\QueryBuilder|null $queryBuilder Query builder
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
    private function getOrCreateQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        return $queryBuilder ?: $this->createQueryBuilder('t');
    }


    // /**
    //  * @return PostMark[] Returns an array of PostMark objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostMark
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * Save record.
     *
     * @param \App\Entity\PostMark $postMark PostMark entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PostMark $postMark): void
    {
        $this->_em->persist($postMark);
        $this->_em->flush($postMark);
    }
    /**
     * Delete record.
     *
     * @param \App\Entity\PostMark $postMark PostMark entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(PostMark $postMark): void
    {
        $this->_em->remove($postMark);
        $this->_em->flush($postMark);
    }
}
