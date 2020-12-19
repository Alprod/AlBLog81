<?php


namespace App\Entity;

use Config\PDOmanager;

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
     * @return mixed
     */
    public function getUserId()
    {
        return $this -> userId;
    }



    /**
     * @return mixed
     */
    public function getIdPosts()
    {
        return $this -> idPosts;
    }

    /**
     * @param mixed $idPosts
     */
    public function setIdPosts($idPosts): void
    {
        $this -> idPosts = $idPosts;
    }

    /**
     * @return mixed
     */
    public function getPostTitle()
    {
        return $this -> postTitle;
    }

    /**
     * @param mixed $postTitle
     */
    public function setPostTitle($postTitle): void
    {
        $this -> postTitle = $postTitle;
    }

    /**
     * @return mixed
     */
    public function getPostContent()
    {
        return $this -> postContent;
    }

    /**
     * @param mixed $postContent
     */
    public function setPostContent($postContent): void
    {
        $this -> postContent = $postContent;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this -> images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images): void
    {
        $this -> images = $images;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this -> link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link): void
    {
        $this -> link = $link;
    }

    /**
     * @return mixed
     */
    public function getPostUserId()
    {
        return $this -> postUserId;
    }

    /**
     * @param mixed $postUserId
     */
    public function setPostUserId($postUserId): void
    {
        $this -> postUserId = $postUserId;
    }

    /**
     * @return mixed
     */
    public function getDateCreateAt()
    {
        return $this -> dateCreateAt;
    }

    /**
     * @param mixed $dateCreateAt
     */
    public function setDateCreateAt($dateCreateAt): void
    {
        $this -> dateCreateAt = $dateCreateAt;
    }


}
