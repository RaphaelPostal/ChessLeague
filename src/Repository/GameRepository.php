<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    // /**
    //  * @return Game[] Returns an array of Game objects
    //  */

    public function findAllWonByColor($value)
    {
        return $this->createQueryBuilder('g')
            ->where('g.'.$value.' = g.winner')
            ->orderBy('g.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllDraw()
    {
        return $this->createQueryBuilder('g')
            ->where('g.winner is NULL')
            ->orderBy('g.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findALLWonByColorAndName($color, $name)
    {
        return $this->createQueryBuilder('g')
            ->innerJoin('g.winner', "player")
            ->innerJoin('g.'.$color, 'playerColor')
            ->where('player.name = :name')
            ->andWhere('playerColor.name =:name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult()
        ;
    }

}
