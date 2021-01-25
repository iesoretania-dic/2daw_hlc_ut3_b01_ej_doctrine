<?php

namespace App\Controller;

use App\Repository\AlumnoRepository;
use App\Repository\GrupoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GrupoController extends AbstractController
{
    /**
     * @Route("/ap8", name="apartado8")
     */
    public function ap8(GrupoRepository $grupoRepository) : Response
    {
        $grupos = $grupoRepository->buscarOrdenados();

        return $this->render('grupo/listado.html.twig', [
            'grupos' => $grupos
        ]);
    }

    /**
     * @Route("/ap9", name="apartado9")
     */
    public function ap9(GrupoRepository $grupoRepository) : Response
    {
        $grupos = $grupoRepository->buscarOrdenadosDescendienteConCuenta();
        dump($grupos);
        return $this->render('grupo/listado_con_cuenta.html.twig', [
            'grupos' => $grupos
        ]);
    }
}