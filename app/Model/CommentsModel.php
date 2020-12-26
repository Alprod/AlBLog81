<?php


namespace App\Model;

use App\Entity\Comments;
use Config\PDOmanager;

class CommentsModel extends PDOmanager
{
    /**
     * @return bool|array
     */
    public function findAllComments()
    {
        $req = 'SELECT *, DATE_FORMAT(dateCreateAt, "%d/%m/%Y") AS dateCreateAt  
                         FROM Comments 
                         INNER JOIN Posts ON idPosts = postCommentId
                         INNER JOIN Users ON idUsers = userCommentId
                         GROUP BY idComments';
        $result = $this->getBdd()->prepare($req);
        $result->execute();
        $result->setFetchMode(self::FETCH_CLASS, 'App\Entity\Comments');
        $data = $result->fetchAll();

        if (!$data) {
            return false;
        }
        return $data;
    }


    /**
     * @param $id
     * @return array
     */
    public function findCommentsByUserId($id)
    {
        $req = 'SELECT * 
                FROM Comments
                INNER JOIN Posts ON idPosts = postCommentId
                INNER JOIN Users ON idUsers = userCommentId 
                WHERE userCommentId = :id
                ORDER BY commentCreateAt
                LIMIT 10';

        $result = $this->getBdd()->prepare($req);
        $result->bindParam(":id", $id);
        $result->execute();
        $result->setFetchMode(self::FETCH_CLASS, 'App\Entity\Comments');
        $data = $result->fetchAll();
        $result->closeCursor();
        return $data;
    }

    /**
     * @param $id
     */
    public function findCommentsById($id)
    {
        $req = 'SELECT * 
                FROM Comments
                JOIN Posts ON idPosts = postCommentId
                JOIN Users ON idUsers = userCommentId
                WHERE idComments = :id';
        $result = $this->getBdd()->prepare($req);
        $result->bindValue(':id', $id);
        $result->execute();
        $result->setFetchMode(self::FETCH_CLASS, 'App\Entity\Comments');

        return $result->fetch();
    }


    /**
     * @param Comments $comment
     */
    public function updateSignal(Comments $comment)
    {
        $req = 'UPDATE Comments 
                SET `signal` = TRUE 
                WHERE idComments = :comment';
        $result = $this->getBdd()->prepare($req);
        $result->bindValue(':comment', $comment->getIdComments());

        return $result->execute();
    }

    public function deleteComment(Comments $id)
    {
        $req = 'DELETE FROM Comments WHERE idComments = :id';
        $result = $this->getBdd()->prepare($req);
        $result->bindValue(':id', $id->getIdComments());
        $result->execute();
        $result->closeCursor();
    }

    public function findCommentsReport()
    {
        $req = 'SELECT idComments, commentTitle, commentContent, pseudo, postTitle 
                FROM Comments 
                INNER JOIN Users ON idUsers = userCommentId
                INNER JOIN Posts ON idPosts = postCommentId
                WHERE `signal` = 1';
        $result = $this->getBdd()->prepare($req);
        $result->execute();
        $result->setFetchMode(self::FETCH_CLASS, "App\Entity\Comments");

        return $result->fetchAll();
    }

    public function updateCommentReport(Comments $id)
    {
        $req = 'UPDATE Comments SET `signal` = FALSE WHERE idComments = :idComment';
        $result = $this->getBdd()->prepare($req);
        $result->bindValue(':idComment', $id->getIdComments());

        return $result->execute();
    }
}
