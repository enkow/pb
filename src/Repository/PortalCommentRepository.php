<?php

namespace App\Repository;

use App\Entity\PortalComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PortalComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method PortalComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method PortalComment[]    findAll()
 * @method PortalComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortalCommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PortalComment::class);
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
    //  * @return PortalComment[] Returns an array of PortalComment objects
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
    public function findOneBySomeField($value): ?PortalComment
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
     * @param \App\Entity\PortalComment $portalComment PortalComment entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PortalComment $portalComment): void
    {
        $this->_em->persist($portalComment);
        $this->_em->flush($portalComment);
    }
    /**
     * Delete record.
     *
     * @param \App\Entity\PortalComment $portalComment PortalComment entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(PortalComment $portalComment): void
    {
        $this->_em->remove($portalComment);
        $this->_em->flush($portalComment);
    }
}
