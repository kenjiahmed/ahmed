<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route(path: '/mes-reservations', name: 'app_reservations_mes')]
    public function mesReservations(): Response
    {
        return $this->render('reservation/mes.html.twig');
    }
}
