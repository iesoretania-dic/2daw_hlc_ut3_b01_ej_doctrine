<?php

namespace App\Repository;

use App\Entity\Alumno;
use App\Entity\Grupo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GrupoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grupo::class);
    }

    public function buscarOrdenados() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT g FROM App\\Entity\\Grupo g ORDER BY g.descripcion")
            ->getResult();
    }
}