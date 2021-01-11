<?php


namespace App\Entity;

use Config\PDOmanager;
use DateTime;
use DateTimeZone;
use Exception;

class Posts extends Entity
{
    private $idPosts;
    private $postTitle;
    private $postContent;
    private $images;
    private $link;
    private $dateCreateAt;
    private $postUserId;
    private $userId;


    public function __set($name, $value)
    {
        if ($this->userId === null) {
            $this->userId = new Users();
        }
        if ($name == 'pseudo') {
            $this->userId->setPseudo($value);
        }
    }

    /**
     * Get idUsers from Users
     * @return mixed
     */
    public function getUserId()
    {
        return $this -> userId;
    }



    /**
     * Get idPosts
     * @return mixed
     */
    public function getIdPosts()
    {
        return $this -> idPosts;
    }

    /**
     * Set idPosts
     * @param mixed $idPosts
     */
    public function setIdPosts($idPosts): void
    {
        $this -> idPosts = $idPosts;
    }

    /**
     * Get postTitle
     * @return mixed
     */
    public function getPostTitle()
    {
        return $this -> postTitle;
    }

    /**
     * Set postTitle
     * @param mixed $postTitle
     */
    public function setPostTitle($postTitle): void
    {
        $this -> postTitle = $postTitle;
    }

    /**
     * Get postContent
     * @return mixed
     */
    public function getPostContent()
    {
        return $this -> postContent;
    }

    /**
     * Set postContent
     * @param mixed $postContent
     */
    public function setPostContent($postContent): void
    {
        $this -> postContent = $postContent;
    }

    /**
     * Get images
     * @return mixed
     */
    public function getImages()
    {
        return $this -> images;
    }

    /**
     * Set images
     * @param mixed $images
     */
    public function setImages($images): void
    {
        $this -> images = $images;
    }

    /**
     * Get link
     * @return mixed
     */
    public function getLink()
    {
        return $this -> link;
    }

    /**
     * Set link
     * @param mixed $link
     */
    public function setLink($link): void
    {
        $this -> link = $link;
    }

    /**
     * Get postUserId
     * @return mixed
     */
    public function getPostUserId()
    {
        return $this -> postUserId;
    }

    /**
     * Set postUserId
     * @param mixed $postUserId
     */
    public function setPostUserId($postUserId): void
    {
        $this -> postUserId = $postUserId;
    }

    /**
     * Get DateCreateAt
     * @return mixed
     * @throws Exception
     */
    public function getDateCreateAt()
    {
        $date = new DateTime($this -> dateCreateAt);
        $dateFormat = $date->format('d/m/Y');
        return $dateFormat;
    }


    /**
     * Set DateCreateAt
     * @param mixed $dateCreateAt
     */
    public function setDateCreateAt($dateCreateAt): void
    {
        $this -> dateCreateAt = $dateCreateAt;
    }


}
