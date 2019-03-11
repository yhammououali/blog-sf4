<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @Route("/article/list", name="article_list")
     */
    public function list(ObjectManager $objectManager)
    {
        $articles = $objectManager->getRepository(Article::class)->findAll();

        return $this->render('article/list.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Using wildcard
     *
     * Doc: https://symfony.com/doc/current/routing.html#adding-wildcard-requirements
     *
     * @Route("/article/read/{slug}", name="article_read")
     */
    public function read($slug, ObjectManager $objectManager)
    {
        $comments = [
            'Deus de germanus solem, dignus hippotoxota!',
            'Magnum, camerarius caniss etiam magicae de superbus, fortis hilotae.',
            'Est varius guttus, cesaris.',
            'Cum domus tolerare, omnes resistentiaes fallere neuter, ferox contencioes.',
        ];

        $article = $objectManager->getRepository(Article::class)->findOneBy(['title' => $slug]);

        //dump($slug, $this);

        return $this->render('article/read.html.twig', [
            'article' => $article,
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

    /**
     * @Route("/article/update/{id}", name="article_update")
     * @ParamConverter("article", class="App\Entity\Article")
     */
    public function update(Request $request, Article $article, ObjectManager $objectManager)
    {
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
