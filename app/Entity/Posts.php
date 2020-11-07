<?php


namespace App\Entity;


use DateTime;

class Posts
{
    private $idPosts;
    private $postTitle;
    private $postContent;
    private $images;
    private $link;
    private DateTime $date_create_at;
    private $post_userId;

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
        return $this -> post_userId;
    }

    /**
     * @param mixed $post_userId
     */
    public function setPostUserId($post_userId): void
    {
        $this -> post_userId = $post_userId;
    }


}