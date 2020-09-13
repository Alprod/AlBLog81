<?php


namespace App\Entity;


use DateTime;

class Posts
{
    private $idPosts;
    private $title;
    private $content;
    private $images;
    private DateTime $dateCreateAt;



    /**
     * @return mixed
     */
    public function getIdPosts()
    {
        return $this->idPosts;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return DateTime
     */
    public function getDateCreateAt(): DateTime
    {
        return $this->dateCreateAt;
    }


    /**
     * @param mixed $idPosts
     */
    public function setIdPosts($idPosts): void
    {
        $this->idPosts = $idPosts;
    }

    /**
     * @param mixed $title
     *
     * @throws ModelException
     */
    public function setTitle($title): void
    {
        if (strlen($title) < 3){
            throw new ModelException('Désoler titre trop court');
        }
        $this->title = $title;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }

    /**
     * @param DateTime $dateCreateAt
     */
    public function setDateCreateAt(DateTime $dateCreateAt): void
    {
        $this->dateCreateAt = $dateCreateAt;
    }



}