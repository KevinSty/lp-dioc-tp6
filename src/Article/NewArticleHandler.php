<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NewArticleHandler
{
    private $articleStat;
    private $slugGenerator;
    private $token;

    /**
     * NewArticleHandler constructor.
     * @param $articleStat
     * @param $slugGenerator
     */
    public function __construct(SlugGenerator $slugGenerator, ArticleStat $articleStat)
    {
        $this->articleStat = $articleStat;
        $this->slugGenerator = $slugGenerator;
    }


    public function handle(Article $article): void
    {
        $article->setSlug($this->slugGenerator->generate($article->getTitle()));
        // Slugify le titre et ajoute l'utilisateur courant comme auteur de l'article
        // Log également un article stat avec pour action create.
    }
}
