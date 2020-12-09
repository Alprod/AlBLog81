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
        $req = 'SELECT *, DATE_FORMAT(create_at, "%d/%m/%Y") AS dateCreate_at  
                         FROM Comments 
                         INNER JOIN Posts ON post_commentId = idPosts
                         INNER JOIN Users ON user_commentId = idUsers
                         GROUP BY idComments';
        $result = $this->getBdd()->prepare($req);
        $result->execute();
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
                        DATE_FORMAT(create_at, "Créer le : %d/%m/%Y") AS dateCreate_at 
                        FROM Comments
                        INNER JOIN Posts
                        INNER JOIN Users
                        WHERE post_commentId = :idPosts
                        AND user_commentId = idUsers
                        ORDER BY dateCreate_at
                        LIMIT 10';

        $result = $this->getBdd()->query($req);
        $result->bindParam(":idPost", $id);
        $result->execute();
        $commentPost = $result->fetch();

        return $commentPost;
    }
}
