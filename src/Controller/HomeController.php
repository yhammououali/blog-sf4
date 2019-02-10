<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function homepage()
    {
        return new Response('OMG! My first Symfony page! :D');
    }
}