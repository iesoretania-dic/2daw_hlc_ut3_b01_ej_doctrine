<?php

namespace App\Controller;

use App\Repository\ProfesorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfesorController extends AbstractController
{
    /**
     * @Route("/ap14", name="apartado14")
     */
    public function ap14(ProfesorRepository $profesorRepository) : Response
    {
        $profesores = $profesorRepository->buscarSinPartes();
        return $this->render('profesor/listado.html.twig', [
            'profesores' => $profesores
        ]);
    }
}