<?php


namespace App\Entity;

class Comments extends Entity
{
    private $idComments;
    private $commentTitle;
    private $commentContent;
    private $commentCreateAt;
    private $postCommentId;
    private $userCommentId;
    private $signal;
    private $postId;
    private $userId;

    public function __set($name, $value)
    {
        if ($this->postId === null && $this->userId === null) {
            $this->postId = new Posts();
            $this->userId= new Users();
        }
        switch ($name) {
            case 'idPosts':
                $this->postId->setIdPosts($value);
                break;
            case 'postTitle':
                $this->postId->setPostTitle($value);
                break;
            case 'images':
                $this->postId->setImages($value);
                break;
            case 'date_create_at':
                $this->postId->setDateCreateAt($value);
                break;
            case 'idUsers':
                $this->userId->setIdUsers($value);
                break;
            case 'pseudo':
                $this->userId->setPseudo($value);
                break;
        }
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this -> postId;
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
    public function getIdComments()
    {
        return $this -> idComments;
    }

    /**
     * @param mixed $idComments
     */
    public function setIdComments($idComments): void
    {
        $this -> idComments = $idComments;
    }

    /**
     * @return mixed
     */
    public function getCommentTitle()
    {
        return $this -> commentTitle;
    }

    /**
     * @param mixed $commentTitle
     */
    public function setCommentTitle($commentTitle): void
    {
        $this -> commentTitle = $commentTitle;
    }

    /**
     * @return mixed
     */
    public function getCommentContent()
    {
        return $this -> commentContent;
    }

    /**
     * @param mixed $commentContent
     */
    public function setCommentContent($commentContent): void
    {
        $this -> commentContent = $commentContent;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getCommentCreateAt()
    {
        $date = new \DateTime($this -> commentCreateAt);
        $dateFormate = $date->format('d/m/Y');
        return $dateFormate;
    }

    /**
     * @param mixed $commentCreateAt
     */
    public function setCommentCreateAt($commentCreateAt): void
    {
        $this -> commentCreateAt = $commentCreateAt;
    }

    /**
     * @return mixed
     */
    public function getPostCommentId()
    {
        return $this -> postCommentId;
    }

    /**
     * @param mixed $postCommentId
     */
    public function setPostCommentId($postCommentId): void
    {
        $this -> postCommentId = $postCommentId;
    }

    /**
     * @return mixed
     */
    public function getUserCommentId()
    {
        return $this -> $userCommentId;
    }

    /**
     * @param mixed $userCommentId
     */
    public function setUserCommentId($userCommentId): void
    {
        $this -> userCommentId = $userCommentId;
    }

    /**
     * @return mixed
     */
    public function getSignal()
    {
        return $this -> signal;
    }

    /**
     * @param mixed $signal
     */
    public function setSignal($signal): void
    {
        $this -> signal = $signal;
    }
}
