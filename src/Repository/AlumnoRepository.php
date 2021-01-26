<?php

namespace App\Repository;

use App\Entity\Alumno;
use App\Entity\Grupo;
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

    public function buscarAnioNacimiento(int $anio) : array
    {
        $fechaInicio = new \DateTime($anio . '-01-01 00:00:00');
        $fechaFinal = new \DateTime(($anio + 1) . '-01-01 00:00:00');

        return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Alumno a 
                WHERE a.fechaNacimiento >= :inicio AND a.fechaNacimiento < :final")
            ->setParameter('inicio', $fechaInicio)
            ->setParameter('final', $fechaFinal)
            ->getResult();
    }

    public function contarAnioNacimiento(int $anio) : string
    {
        $fechaInicio = new \DateTime($anio . '-01-01 00:00:00');
        $fechaFinal = new \DateTime(($anio + 1) . '-01-01 00:00:00');

        return $this
            ->getEntityManager()
            ->createQuery("SELECT COUNT(a) FROM App\\Entity\\Alumno a 
                WHERE a.fechaNacimiento >= :inicio AND a.fechaNacimiento < :final")
            ->setParameter('inicio', $fechaInicio)
            ->setParameter('final', $fechaFinal)
            ->getSingleScalarResult();
    }

    public function buscarAnioNacimientoOrdenado(int $anio) : array
    {
        $fechaInicio = new \DateTime($anio . '-01-01 00:00:00');
        $fechaFinal = new \DateTime(($anio + 1) . '-01-01 00:00:00');

        return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Alumno a 
                WHERE a.fechaNacimiento >= :inicio AND a.fechaNacimiento < :final
                ORDER BY a.fechaNacimiento DESC")
            ->setParameter('inicio', $fechaInicio)
            ->setParameter('final', $fechaFinal)
            ->getResult();
    }

    public function buscarPorGrupo(Grupo $grupo) : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Alumno a 
                WHERE a.grupo = :grupo")
            ->setParameter('grupo', $grupo)
            ->getResult();
    }


    public function buscarOrdenadosConCuentaPartesDescendentes() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT a AS alumno, SIZE(a.partes) AS num FROM App\\Entity\\Alumno a ORDER BY num DESC")
            ->getResult();
    }


    public function buscarOrdenadosSinPartes() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Alumno a WHERE SIZE(a.partes) = 0 ORDER BY a.apellidos, a.nombre")
            ->getResult();
    }
    public function buscarOrdenadosSinPartesJSON() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT a.id, a.apellidos, a.nombre FROM App\\Entity\\Alumno a WHERE SIZE(a.partes) = 0 ORDER BY a.apellidos, a.nombre")
            ->getArrayResult();
    }
}