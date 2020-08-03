<?php


namespace App\Model;


class Post
{
    private $id;
    private $title;
    private $content;
    private \DateTime $dateCreateAt;

    /**
     * Post constructor.
     * @param $title
     * @param $content
     */
    public function __construct($title, $content)
    {
        $this->setTitle($title);
        $this->setContent($content);
        $this->dateCreateAt = new \DateTime;
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
     * @return \DateTime
     */
    public function getDateCreateAt(): \DateTime
    {
        return $this->dateCreateAt;
    }


    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        if (strlen($title) < 3){
            throw new Exception('Le titre est non valide');
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

}