<?php /** @noinspection NullPointerExceptionInspection */


namespace App\Model;

use Config\PDOmanager;
use DateTime;
use DateTimeZone;
use Exception;
use PDOStatement;

class PostsModel extends PDOmanager
{

    /**
     * @return false|PDOStatement
     */
    public function findAllPosts()
    {
        $requete = 'SELECT lastname,
                           pseudo,
                           idPosts, 
                           postTitle,
                           images,
                           postContent, 
                           DATE_FORMAT(date_create_at, "%d/%m/%Y") AS create_at
                           FROM Posts
                           INNER JOIN Users
                           WHERE post_userId = idUsers
                           ORDER BY create_at LIMIT 0,15';
        $resultat = $this->getBdd()->query($requete);

        if (!$resultat) {
            return false;
        }

        return $resultat;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findPostByIds($id)
    {
        $req = 'SELECT *,
                       DATE_FORMAT(date_create_at, "%d/%m/%Y") as create_at 
                       FROM Posts 
                       WHERE idPosts = :id_post';
        $result = $this->getBdd()->prepare($req);
        $result->bindParam(":id_post", $id);
        $result->execute();
        $posts= $result->fetch();

        return $posts;
    }

    /**
     * @param $id
     * @return array
     */
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
                ORDER BY dateCreate_at ASC LIMIT 0,10';

        $result = $this->getBdd()->prepare($req);
        $result->bindParam(":idPosts", $id);
        $result->execute();
        $commentPost = $result->fetchAll();

        return $commentPost;
    }

    public function findCommentById($id)
    {
        $bdd = $this->getBdd();
        $req = 'SELECT *,DATE_FORMAT(create_at, "Créer le : %d/%m/%Y") as dateCreateAt 
                FROM Comments
                INNER JOIN Posts ON idPosts = post_commentId
                INNER JOIN Users ON idUsers = user_commentId 
                WHERE user_commentId = :id';
        $result = $bdd->prepare($req);
        $result->bindParam(':id', $id);
        $result->execute();
        $commentUser = $result->fetchAll();

        return $commentUser;
    }

    /**
     * Attention ne pas oublier de changer user_commentId
     * par l'id session de l'utilisateur.
     * @param $commentId
     * @param $postId
     * @param $title
     * @param $comment
     */
    public function addCommentToPost($commentId, $postId, $title, $comment)
    {
        $bdd = $this->getBdd();
        $request = $bdd->prepare('INSERT INTO Comments (
                                                        commentTitle,
                                                        commentContent,
                                                        create_at,
                                                        post_commentId,
                                                        user_commentId)
                                                VALUES (
                                                        :title,
                                                        :contenu,
                                                        NOW(),
                                                        :idPost,
                                                        :idComments)');
        $request->bindParam(':title', $title);
        $request->bindParam(':contenu', $comment);
        $request->bindParam(':idPost', $postId);
        $request->bindParam(':idComments', $commentId);
        $request->execute();
    }

    /**
     * @param $postTitle
     * @param $postContent
     * @param $image
     * @param $link
     */
    public function editPost($postTitle, $postContent, $image, $link)
    {
        $bdd = $this->getBdd();
        $request = $bdd->prepare('INSERT INTO Posts (
                                                                postTitle,
                                                                postContent,
                                                                images,
                                                                link,
                                                                date_create_at,
                                                                post_userId)
                                                         VALUES (:title,
                                                                 :content,
                                                                 :images,
                                                                 :link,
                                                                 NOW(),
                                                                 :idUser)');
        $request->bindParam(':title', $postTitle);
        $request->bindParam(':content', $postContent);
        $request->bindParam(':images', $image);
        $request->bindParam(':link', $link);
        $request->bindParam(':idUser', $_SESSION['id_membre']);
        $request->execute();
    }

    /**
     * @param $post => $_Post
     * @return bool
     * @throws Exception
     */
    public function updatePost($post)
    {
        $newValue = array();
        foreach ($post as $key => $value) {
            $newValue[] = "$key = :$key";
        }

        $bdd = $this->getBdd();
        $request = 'UPDATE Posts SET '.implode(',', $newValue).' WHERE idPosts = :idPosts';
        $result = $bdd->prepare($request);

        return $result->execute($post);
    }

    /**
     * @param $id
     */
    public function deletePost($id)
    {
        $bdd = $this->getBdd();
        $request = $bdd->prepare('DELETE FROM Posts WHERE idPosts = :id');
        $request->bindParam(':id', $id);
        $request->execute();
    }
}
