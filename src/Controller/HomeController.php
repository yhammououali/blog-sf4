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

    /**
     * @Route("/article/why-you-should-learn-symfony")
     */
//    public function read()
//    {
//        return new Response('Article is coming very soon!');
//    }

    /**
     * Using wildcard
     *
     * Doc: https://symfony.com/doc/current/routing.html#adding-wildcard-requirements
     *
     * @Route("/article/{slug}")
     */
    public function read($slug)
    {
        return new Response(sprintf(
            'Article: "%s" is coming very soon',
            $slug
        ));
    }
}