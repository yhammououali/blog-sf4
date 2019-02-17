<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
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
        $comments = [
            'Deus de germanus solem, dignus hippotoxota!',
            'Magnum, camerarius caniss etiam magicae de superbus, fortis hilotae.',
            'Est varius guttus, cesaris.',
            'Cum domus tolerare, omnes resistentiaes fallere neuter, ferox contencioes.',
        ];

        //dump($slug, $this);

        return $this->render('article/read.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
        ]);
    }
}
