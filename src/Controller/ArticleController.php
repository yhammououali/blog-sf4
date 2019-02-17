<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
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
     * @Route("/article/read/{slug}", name="article_read")
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

    /**
     * @Route("/article/create", name="article_create")
     */
    public function create(Request $request, ObjectManager $objectManager)
    {
        $article = new Article();

//        $form = $this->createFormBuilder($article)
//            ->add('title', TextType::class)
//            ->add('content', TextareaType::class)
//            ->add('author', TextType::class, [
//                'required' => true,
//            ])
//            ->add('submit', SubmitType::class)
//            ->getForm();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData());
            //die;

            $objectManager->persist($article);
            $objectManager->flush();

            return $this->redirectToRoute('article_read', [
                'slug' => $article->getTitle(),
            ]);
        }

        return $this->render('article/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
