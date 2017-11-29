<?php

namespace App\Controller;

use App\Article\CountViewUpdater;
use App\Article\NewArticleHandler;
use App\Article\UpdateArticleHandler;
use App\Article\ViewArticleHandler;
use App\Entity\Article;
use App\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/article")
 */
class ArticleController extends Controller {

    /**
     * @Route(path="/show/{slug}", name="article_show")
     */
    public function showAction() {

        return $this->render('Article/show.html.twig');
    }

    /**
     * @Route(path="/new", name="article_new")
     */
    public function newAction(Request $request) {

        if($this->getUser()->getRoles() != 'ROLE_AUTHOR') {

            $article = $this->get(\App\Entity\Article::class);
            $form = $this->createForm(ArticleType::class);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                /*
                $articleHandler->handle($form->getData());
                $manager->flush();*/
                $em = $this->getDoctrine()->getManager();
                $em-> persist($article);
                $em-> flush();

            }

            return $this->render('Article/new.html.twig', ['form' => $form->createView()]);
        }
    }

    /**
     * @Route(path="/update/{slug}", name="article_update")
     */
    public function updateAction() {
        // Seul les auteurs doivent avoir access.
        // Seul l'auteur de l'article peut le modifier
        if($this->getUser()->getRoles() == 'ROLE_AUTHOR') {
            return $this->render('Article/update.html.twig');
        }
    }
}
