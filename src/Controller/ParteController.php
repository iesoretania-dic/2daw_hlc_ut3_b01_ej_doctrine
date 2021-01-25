<?php

namespace App\Controller;

use App\Entity\Grupo;
use App\Entity\Profesor;
use App\Repository\ProfesorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParteController extends AbstractController
{
    /**
     * @Route("/ap11", name="apartado11")
     */
    public function ap11(ProfesorRepository $profesorRepository) : Response
    {
        $profesores = $profesorRepository->buscarOrdenados();
        return $this->render('parte/listado_profesorado.html.twig', [
            'profesores' => $profesores
        ]);
    }

    /**
     * @Route("/ap11/{id}", name="apartado11_partes")
     */
    public function ap11Partes(Profesor $profesor) : Response
    {
        $partes = $profesor->getPartes();
        return $this->render('parte/listado.html.twig', [
            'partes' => $partes
        ]);
    }

    /**
     * @Route("/listadoAlumnado/{id}", name="apartado10_alumnado")
     */
    public function ap10alumnado(Grupo $grupo) : Response
    {
        $alumnado = $grupo->getAlumnado();
        return $this->render('alumno/listado_grupo.html.twig', [
            'alumnos' => $alumnado,
            'grupo' => $grupo
        ]);
    }
}