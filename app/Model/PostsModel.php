<?php /** @noinspection NullPointerExceptionInspection */


namespace App\Model;


use Config\PDOmanager;


class PostsModel extends PDOmanager
{

    public function findAllPosts()
    {
        $requete = 'SELECT lastname,
                           pseudo,
                           idPosts, 
                           postTitle,
                           images,
                           postContent, 
                           DATE_FORMAT(date_create_at, "Créer le : %d/%m/%Y") AS create_at
                           FROM Posts
                           INNER JOIN Users
                           WHERE post_userId = idUsers
                           ORDER BY create_at';
        $resultat = $this->getBdd()->query($requete);

        if (!$resultat) {
            return false;
        }

        return $resultat;
    }

    public function findPostByIds($id)
    {
        $req = 'SELECT idPosts, 
                       postTitle, 
                       postContent, 
                       images,
                       link,
                       DATE_FORMAT(date_create_at, "Créer le : %d/%m/%Y") as create_at 
                       FROM Posts 
                       WHERE idPosts = :id_post';
        $result = $this->getBdd()->prepare($req);
        $result->bindParam(":id_post", $id);
        $result->execute();
        $posts= $result->fetch();

        return $posts;
    }

    public function findCommentsByPostAndIds($id)
    {
        $req = 'SELECT idComments,
                        pseudo,
                        commentTitle,
                        commentContent,
                        DATE_FORMAT(date_create_at, "Créer le : %d/%m/%Y") as dateCreate_at,
                        idPosts,
                        idUsers
                FROM Comments
                INNER JOIN Posts on idPosts = post_commentId
                INNER JOIN Users on idUsers = user_commentId
                WHERE post_commentId = :idPosts
                ORDER BY dateCreate_at ASC;';

        $result = $this->getBdd()->prepare($req);
        $result->bindValue(":idPosts",$id);
        $result->execute();
        $commentPost = $result->fetchAll();

        return $commentPost;
    }

}
