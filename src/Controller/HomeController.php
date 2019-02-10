<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('OMG! My first Symfony page! :D');
    }
}