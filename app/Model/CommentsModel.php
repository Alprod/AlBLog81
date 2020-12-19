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
        $req = 'SELECT idComments,
                        firstname,
                        lastname,
                        pseudo,
                        idUsers,
                        commentTitle,
                        commentContent,
                        idPosts,postTitle,
                        DATE_FORMAT(dateCreateAt, "Créer le : %d/%m/%Y") AS dateCreateAt 
                        FROM Comments
                        INNER JOIN Posts
                        INNER JOIN Users
                        WHERE post_commentId = :idPosts
                        AND user_commentId = idUsers
                        ORDER BY dateCreateAt
                        LIMIT 10';

        $result = $this->getBdd()->query($req);
        $result->bindParam(":idPost", $id);
        $result->execute();
        $commentPost = $result->fetch();

        return $commentPost;
    }
}
