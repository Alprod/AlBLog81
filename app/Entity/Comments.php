<?php


namespace App\Entity;

/**
 * Class Comments
 *
 * @package App\Entity
 */
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

    /**
     * @param $name
     * @param $value
     */
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
     * Get postId
     *
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Get userId
     *
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get idComments
     *
     * @return mixed
     */
    public function getIdComments()
    {
        return $this->idComments;
    }

    /**
     * Set idComments
     *
     * @param mixed mixed $idComments
     */
    public function setIdComments($idComments): void
    {
        $this->idComments = $idComments;
    }

    /**
     * Get commentTitle
     *
     * @return mixed
     */
    public function getCommentTitle()
    {
        return $this->commentTitle;
    }

    /**
     * Set commentTitle
     *
     * @param mixed $commentTitle
     */
    public function setCommentTitle($commentTitle): void
    {
        $this->commentTitle = $commentTitle;
    }

    /**
     * Get commentContent
     *
     * @return mixed
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }

    /**
     * Set commentContent
     *
     * @param mixed $commentContent
     */
    public function setCommentContent($commentContent): void
    {
        $this->commentContent = $commentContent;
    }

    /**
     * Get commentCreateAt
     *
     * @return mixed
     * @throws \Exception
     */
    public function getCommentCreateAt()
    {
        $date = new \DateTime($this->commentCreateAt);
        $dateFormate = $date->format('d/m/Y');
        return $dateFormate;
    }

    /**
     * Set commentCreateAt
     *
     * @param mixed $commentCreateAt
     */
    public function setCommentCreateAt($commentCreateAt): void
    {
        $this->commentCreateAt = $commentCreateAt;
    }

    /**
     * Get postCommentId
     *
     * @return mixed
     */
    public function getPostCommentId()
    {
        return $this->postCommentId;
    }

    /**
     * Set commentPostid
     *
     * @param mixed $postCommentId
     */
    public function setPostCommentId($postCommentId): void
    {
        $this->postCommentId = $postCommentId;
    }

    /**
     * Get userCommentId
     *
     * @return mixed
     */
    public function getUserCommentId()
    {
        return $this->userCommentId;
    }

    /**
     *  Set userCommentId
     *
     * @param mixed $userCommentId
     */
    public function setUserCommentId($userCommentId): void
    {
        $this->userCommentId = $userCommentId;
    }

    /**
     *  Get signal
     *
     * @return mixed
     */
    public function getSignal()
    {
        return $this->signal;
    }

    /**
     *  Set signal
     *
     * @param mixed $signal
     */
    public function setSignal($signal): void
    {
        $this->signal = $signal;
    }
}
