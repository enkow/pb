<?php
/**
 * PortalUser repository.
 */
namespace App\Repository;
use App\Entity\PortalUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;
/**
 *  * Class PortalUserRepository.
 *
 * @method PortalUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method PortalUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method PortalUser[]    findAll()
 * @method PortalUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortalUserRepository extends ServiceEntityRepository
{
    /**
     * PortalUserRepository constructor.
     *
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $registry Registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PortalUser::class);
    }
    /**
     * Query all records.
     *
     * @return \Doctrine\ORM\QueryBuilder Query builder
     */
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
    //  * @return PortalUser[] Returns an array of PortalUser objects
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
    public function findOneBySomeField($value): ?PortalUsers
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
     * @param \App\Entity\PortalUser $portalUser PortalUser entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PortalUser $portalUser): void
    {
        $this->_em->persist($portalUser);
        $this->_em->flush($portalUser);
    }
    /**
     * Delete record.
     *
     * @param \App\Entity\PortalUser $portalUser PortalUser entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(PortalUser $portalUser): void
    {
        $this->_em->remove($portalUser);
        $this->_em->flush($portalUser);
    }
}
