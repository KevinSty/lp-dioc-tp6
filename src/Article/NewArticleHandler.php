<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NewArticleHandler
{
    private $articleStat;
    private $slugGenerator;
    private $token;
    private $em;

    /**
     * NewArticleHandler constructor.
     * @param $slugGenerator
     */
    public function __construct(Registry $em,TokenStorage $token, SlugGenerator $slugGenerator)
    {
        $this->slugGenerator = $slugGenerator;
        $this->token = $token;
        $this->em = $em->getManager();
    }


    public function handle(Article $article): void
    {
        $article->setSlug($this->slugGenerator->generate($article->getTitle()));
        $article->setAuthor($this->token->getToken()->getUser());
        $this->setUpdatedAt(new \DateTime());
        $this->setCreatedAt(new \DateTime());
        $this->em->persist($article);
        $this->em->flush();
        // Slugify le titre et ajoute l'utilisateur courant comme auteur de l'article
        // Log également un article stat avec pour action create.
    }
}
