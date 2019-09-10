<?php

namespace App\Repository;

use App\Entity\PortalPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PortalPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method PortalPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method PortalPost[]    findAll()
 * @method PortalPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortalPostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PortalPost::class);
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
    //  * @return PortalPost[] Returns an array of PortalPost objects
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
    public function findOneBySomeField($value): ?PortalPost
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
     * @param \App\Entity\PortalPost $portalPost PortalPost entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PortalPost $portalPost): void
    {
        $this->_em->persist($portalPost);
        $this->_em->flush($portalPost);
    }
    /**
     * Delete record.
     *
     * @param \App\Entity\PortalPost $portalPost PortalPost entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(PortalPost $portalPost): void
    {
        $this->_em->remove($portalPost);
        $this->_em->flush($portalPost);
    }
}
