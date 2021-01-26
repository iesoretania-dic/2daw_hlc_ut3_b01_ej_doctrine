<?php

namespace App\Repository;

use App\Entity\Parte;
use App\Entity\Profesor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ParteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parte::class);
    }

    public function buscarPorProfesorOrdenados(Profesor $profesor) : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT p FROM App\\Entity\\Parte p WHERE p.profesor = :profesor ORDER BY p.fechaCreacion DESC")
            ->setParameter('profesor', $profesor)
            ->getResult();
    }

    public function buscarPorTexto(string $texto)
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT p, a, pr, g FROM App\\Entity\\Parte p JOIN p.alumno a JOIN p.profesor pr JOIN a.grupo g WHERE p.observaciones LIKE :texto")
            ->setParameter('texto', '%' . $texto . '%')
            ->getResult();
    }
}