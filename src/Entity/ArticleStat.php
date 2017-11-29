<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="articlestats")
 */
class ArticleStat {
    const CREATE = 'create';
    const UPDATE = 'update';
    const VIEW = 'view';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $action;
    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="articlestats")
     */
    private $article;
    /**
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    private $date;
    /**
     * @ORM\Column(type="integer")
     */
    private $ip;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="users")
     */
    private $user;

    /**
     * ArticleStat constructor.
     * @param $action
     * @param $article
     * @param \DateTime $date
     * @param $ip
     * @param $user
     */
    public function __construct($action, $article, \DateTime $date, $ip, $user)
    {
        $this->action = $action;
        $this->article = $article;
        $this->date = $date;
        $this->ip = $ip;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }


}
