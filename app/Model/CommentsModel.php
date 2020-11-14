<?php


namespace App\Model;


use Config\PDOmanager;

class CommentsModel extends PDOmanager
{

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
        $result->bindParam(":idPost",$id);
        $result->execute();
        $commentPost = $result->fetch();

        return $commentPost;
    }

}