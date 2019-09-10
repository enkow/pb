<?php

namespace App\Repository;

use App\Entity\PortalPhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PortalPhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method PortalPhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method PortalPhoto[]    findAll()
 * @method PortalPhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortalPhotoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PortalPhoto::class);
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
    //  * @return PortalPhoto[] Returns an array of PortalPhoto objects
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
    public function findOneBySomeField($value): ?PortalPhoto
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
     * @param \App\Entity\PortalPhoto $portalPhoto PortalPhoto entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PortalPhoto $portalPhoto): void
    {
        $this->_em->persist($portalPhoto);
        $this->_em->flush($portalPhoto);
    }
    /**
     * Delete record.
     *
     * @param \App\Entity\PortalPhoto $portalPhoto PortalPhoto entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(PortalPhoto $portalPhoto): void
    {
        $this->_em->remove($portalPhoto);
        $this->_em->flush($portalPhoto);
    }
}
