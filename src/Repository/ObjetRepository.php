<?php

namespace App\Repository;

use App\Entity\Objet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Objet>
 *
 * @method Objet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Objet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Objet[]    findAll()
 * @method Objet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Objet::class);
    }

    public function add(Objet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Objet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByActive()
    {
        return $this->createQueryBuilder('o')
             ->where('o.status = 0 ')
            ->andWhere('o.active = 1')
            ->andWhere('o.isfound = 0')
            // ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    public function findByUser( $user)
    {
        return $this->createQueryBuilder('o')
             ->where('o.status = 0 ')
            ->andWhere('o.active = 1')
            ->andWhere('o.isfound = 0')
            ->andWhere('o.User = :user')
             ->setParameter('user', $user)
            ->orderBy('o.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    
    public function lostByUser( $user)
    {
        return $this->createQueryBuilder('o')
            ->where('o.status = 1 ')
            ->andWhere('o.active = 1')
            ->andWhere('o.isfound = 0')
            ->andWhere('o.User = :user')
            ->setParameter('user', $user)
            ->orderBy('o.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function statusByUser( $user)
    {
        return $this->createQueryBuilder('o')
            ->where('o.status = 1 ')
            ->andWhere('o.active = 1')
            ->andWhere('o.isfound = 0')
            ->andWhere('o.User = :user')
            ->setParameter('user', $user)
            ->orderBy('o.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByCategory( $category ,$user)
    {
        return $this->createQueryBuilder('o')
             ->where('o.status = 1 ')
            ->andWhere('o.active = 1')
            ->andWhere('o.isfound = 0')
            ->andWhere('o.User != :user')
            ->andWhere('o.categories =:category')
            
             ->setParameter('user', $user)
             ->setParameter('category', $category)
            ->orderBy('o.categoriesdetails', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    

    public function findByDetailsCategory( $categoriesdetails ,$user)
    {
        return $this->createQueryBuilder('o')
             ->where('o.status = 1 ')
            ->andWhere('o.active = 1')
            ->andWhere('o.isfound = 0')
            ->andWhere('o.User != :user')
            ->andWhere('o.categoriesdetails =:categoriesdetails')
             ->setParameter('user', $user)
             ->setParameter('categoriesdetails', $categoriesdetails)
            ->orderBy('o.categoriesdetails', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByobjectname( $objectname ,$user)
    {
        return $this->createQueryBuilder('o')
             ->where('o.status = 1 ')
            ->andWhere('o.active = 1')
            ->andWhere('o.isfound = 0')
            ->andWhere('o.User != :user')
            ->andWhere('o.objectname =:objectname')
             ->setParameter('user', $user)
             ->setParameter('objectname', $objectname)
            ->orderBy('o.categoriesdetails', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Objet[] Returns an array of Objet objects
//     */
   public function findByExampleField($user): array
   {
       return $this->createQueryBuilder('o')
           ->andWhere('o.status =0')
           ->andWhere('o.User = :user')
           ->setParameter('user', $user)
           ->orderBy('o.id', 'ASC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
    }

    public function findObjectsByUser( $user)
    {
        return $this->createQueryBuilder('o')
             ->where('o.status = 0 ')
            ->andWhere('o.active = 1')
            ->andWhere('o.isfound = 0')
            ->andWhere('o.User = :user')
             ->setParameter('user', $user)
            ->orderBy('o.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    public function LostObjectsByOthers( $user)
    {
        return $this->createQueryBuilder('o')
             ->where('o.status = 1 ')
            ->andWhere('o.active = 1')
            ->andWhere('o.isfound = 0')
            ->andWhere('o.User != :user')
             ->setParameter('user', $user)
            ->orderBy('o.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    public function findByObjectlostCategory( $category ,$user)
    {
        return $this->createQueryBuilder('o')
             ->where('o.status = 1 ')
            ->andWhere('o.active = 1')
            ->andWhere('o.isfound = 0')
            ->andWhere('o.User != :user')
            ->andWhere('o.category =:category')
             ->setParameter('user', $user)
             ->setParameter('category', $category)
            ->orderBy('o.categoryDetails', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByObjectlostDetailsCategory( $ids , $categoryDetails )
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.id in (:ids)')
            ->andWhere('o.categoryDetails =:categoryDetails')
             ->setParameter('categoryDetails', $categoryDetails)
             ->setParameter('ids',array_values($ids) )
            ->orderBy('o.categoryDetails', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByObjectlostCity( $ids , $lostCity )
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.id in (:ids)')
            ->andWhere('o.lostCity =:lostCity')
             ->setParameter('lostCity', $lostCity)
             ->setParameter('ids',array_values($ids) )
            ->orderBy('o.lostCity', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }





}