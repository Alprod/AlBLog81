<?php


namespace App\Entity;


class Comments extends Entity
{
    private $idComments;
    private $commentTitle;
    private $commentContent;
    private $create_at;
    private $post_commentId;
    private $user_commentId;

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
     */
    public function getCreateAt()
    {
        return $this -> create_at;
    }

    /**
     * @param mixed $create_at
     */
    public function setCreateAt($create_at): void
    {
        $this -> create_at = $create_at;
    }

    /**
     * @return mixed
     */
    public function getPostCommentId()
    {
        return $this -> post_commentId;
    }

    /**
     * @param mixed $post_commentId
     */
    public function setPostCommentId($post_commentId): void
    {
        $this -> post_commentId = $post_commentId;
    }

    /**
     * @return mixed
     */
    public function getUserCommentId()
    {
        return $this -> user_commentId;
    }

    /**
     * @param mixed $user_commentId
     */
    public function setUserCommentId($user_commentId): void
    {
        $this -> user_commentId = $user_commentId;
    }

}