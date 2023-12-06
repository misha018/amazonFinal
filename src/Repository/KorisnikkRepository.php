<?php

namespace App\Repository;

use App\Entity\Korisnikk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Korisnikk>
 *
 * @method Korisnikk|null find($id, $lockMode = null, $lockVersion = null)
 * @method Korisnikk|null findOneBy(array $criteria, array $orderBy = null)
 * @method Korisnikk[]    findAll()
 * @method Korisnikk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KorisnikkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Korisnikk::class);
    }

    public function save(Korisnikk $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Korisnikk $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    

//    /**
//     * @return Korisnikk[] Returns an array of Korisnikk objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('k.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Korisnikk
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
