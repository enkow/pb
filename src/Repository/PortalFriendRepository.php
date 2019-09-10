<?php
/**
 * PortalFriend repository.
 */

namespace App\Repository;

use App\Entity\PortalFriend;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 *  *  * Class PortalFriendRepository.
 *
 * @method PortalFriend|null find($id, $lockMode = null, $lockVersion = null)
 * @method PortalFriend|null findOneBy(array $criteria, array $orderBy = null)
 * @method PortalFriend[]    findAll()
 * @method PortalFriend[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortalFriendRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PortalFriend::class);
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
    //  * @return PortalFriend[] Returns an array of PortalFriend objects
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
    public function findOneBySomeField($value): ?PortalFriend
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
     * @param \App\Entity\PortalFriend $portalFriend PortalFriend entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PortalFriend $portalFriend): void
    {
        $this->_em->persist($portalFriend);
        $this->_em->flush($portalFriend);
    }
    /**
     * Delete record.
     *
     * @param \App\Entity\PortalFriend $portalFriend PortalFriend entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(PortalFriend $portalFriend): void
    {
        $this->_em->remove($portalFriend);
        $this->_em->flush($portalFriend);
    }
}
