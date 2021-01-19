<?php

namespace App\Controller;

use App\Repository\AlumnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NombreController extends AbstractController
{
    /**
     * @Route("/ap1", name="apartado1")
     */
    public function ap1(AlumnoRepository $alumnoRepository) : Response
    {
        $alumnos = $alumnoRepository->buscarMaria();

        return $this->render('alumno/listado.html.twig', [
            'alumnos' => $alumnos
        ]);
    }

    /**
     * @Route("/ap2", name="apartado2")
     */
    public function ap2(AlumnoRepository $alumnoRepository) : Response
    {
        $alumnos = $alumnoRepository->buscarNoMaria();

        return $this->render('alumno/listado.html.twig', [
            'alumnos' => $alumnos
        ]);
    }
}