<?php


namespace App\Model;

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
                         INNER JOIN Posts ON postCommentId = idPosts
                         INNER JOIN Users ON userCommentId = idUsers
                         GROUP BY idComments';
        $result = $this->getBdd()->prepare($req);
        $result->execute();
        $result->setFetchMode(\PDO::FETCH_CLASS, 'App\Entity\Comments');
        $data = $result->fetchAll();
        if (!$data) {
            return false;
        }
        return $data;
    }

    public function findCommentsByIds($id)
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
        $commentPost = $result->fetchAll();

        return $commentPost;
    }
}
