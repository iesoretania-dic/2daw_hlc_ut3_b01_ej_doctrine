<?php

namespace App\Controller;

use App\Repository\AlumnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlumnoController extends AbstractController
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

    /**
     * @Route("/ap3/{nombre}", name="apartado3")
     */
    public function ap3(AlumnoRepository $alumnoRepository, string $nombre) : Response
    {
        $alumnos = $alumnoRepository->buscarNombre($nombre);

        return $this->render('alumno/listado.html.twig', [
            'alumnos' => $alumnos
        ]);
    }

    /**
     * @Route("/ap4", name="apartado4")
     */
    public function ap4(AlumnoRepository $alumnoRepository) : Response
    {
        $alumnos = $alumnoRepository->buscarApellido('Ojeda');

        return $this->render('alumno/listado.html.twig', [
            'alumnos' => $alumnos
        ]);
    }

    /**
     * @Route("/ap5", name="apartado5")
     */
    public function ap5(AlumnoRepository $alumnoRepository) : Response
    {
        $alumnos = $alumnoRepository->buscarAnioNacimiento(1997);

        return $this->render('alumno/listado.html.twig', [
            'alumnos' => $alumnos
        ]);
    }

    /**
     * @Route("/ap6", name="apartado6")
     */
    public function ap6(AlumnoRepository $alumnoRepository) : Response
    {
        $cuenta = $alumnoRepository->contarAnioNacimiento(1997);

        return $this->render('alumno/cuenta.html.twig', [
            'cuenta' => $cuenta
        ]);
    }

    /**
     * @Route("/ap7/{anio}", name="apartado7", requirements={"anio":"\d+"})
     */
    public function ap7(AlumnoRepository $alumnoRepository, int $anio) : Response
    {
        $alumnos = $alumnoRepository->buscarAnioNacimientoOrdenado($anio);

        return $this->render('alumno/listado.html.twig', [
            'alumnos' => $alumnos
        ]);
    }

    /**
     * @Route("/ap12", name="apartado12")
     */
    public function ap12(AlumnoRepository $alumnoRepository) : Response
    {
        $items = $alumnoRepository->buscarOrdenadosConCuentaPartesDescendentes();

        return $this->render('alumno/listado_con_partes.html.twig', [
            'items' => $items
        ]);
    }

    /**
     * @Route("/ap15", name="apartado15")
     */
    public function ap15(AlumnoRepository $alumnoRepository) : Response
    {
        $alumnos = $alumnoRepository->buscarOrdenadosSinPartes();

        return $this->render('alumno/listado.html.twig', [
            'alumnos' => $alumnos
        ]);
    }

    /**
     * @Route("/json/ap15", name="apartado15_json")
     */
    public function ap15JSON(AlumnoRepository $alumnoRepository) : Response
    {
        $alumnos = $alumnoRepository->buscarOrdenadosSinPartesJSON();

        return new JsonResponse($alumnos);
    }
}