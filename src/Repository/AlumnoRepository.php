<?php

namespace App\Repository;

use App\Entity\Alumno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AlumnoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alumno::class);
    }

    public function buscarMaria() : array
    {
        //return $this->findBy(['nombre' => 'María']);
        /*return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Alumno a WHERE a.nombre = 'María'")
            ->getResult();*/
        return $this->buscarNombre('María');
    }

    public function buscarNoMaria() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Alumno a WHERE a.nombre != 'María'")
            ->getResult();
    }

    public function buscarNombre(string $nombre) : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Alumno a WHERE a.nombre = :nom")
            ->setParameter('nom', $nombre)
            ->getResult();
    }

    public function buscarApellido(string $apellido) : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Alumno a 
                WHERE a.apellidos LIKE :ape
                ORDER BY a.nombre")
            ->setParameter('ape', $apellido . '%')
            ->getResult();
    }
}