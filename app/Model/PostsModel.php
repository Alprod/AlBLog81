<?php /** @noinspection NullPointerExceptionInspection */


namespace App\Model;

use App\Entity\Posts;
use App\Entity\Users;
use Config\PDOmanager;
use DateTime;
use DateTimeZone;
use Exception;
use PDOStatement;

class PostsModel extends PDOmanager
{

    /**
     * @return bool|array
     */
    public function findAllPosts()
    {
        $requete = 'SELECT u.lastname,
                           u.pseudo,
                           p.idPosts, 
                           p.postTitle,
                           p.images,
                           p.postContent,
                           DATE_FORMAT(p.date_create_at, "%d/%m/%Y") AS create_at,
                           p.post_userId
                           FROM Posts AS p
                           JOIN Users AS u
                           WHERE p.post_userId = u.idUsers
                           ORDER BY create_at LIMIT 0,15';
        $resultat = $this->getBdd()->prepare($requete);
        $resultat->execute();
        $resultat->setFetchMode(self::FETCH_CLASS, "App\Entity\Posts");
        $data = $resultat->fetchAll();

        if (!$data) {
            return false;
        }

        return $data;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findPostByIds($id)
    {
        $req = 'SELECT *, pseudo, DATE_FORMAT(date_create_at, "%d/%m/%Y") as create_at 
                FROM Posts 
                JOIN Users ON Users.idUsers = Posts.post_userId
                WHERE idPosts = :id_post';
        $result = $this->getBdd()->prepare($req);
        $result->bindParam(":id_post", $id);
        $result->execute();
        $result->setFetchMode(self::FETCH_CLASS, "App\Entity\Posts");
        $posts= $result->fetch();

        return $posts;
    }

    public function findPostsByIdUser($id)
    {
        $req = 'SELECT *, DATE_FORMAT(date_create_at, "%d/%m/%Y") as create_at 
                FROM Posts 
                WHERE post_userId = :id_user';
        $result = $this->getBdd()->prepare($req);
        $result->bindParam(":id_user", $id);
        $result->execute();
        $posts= $result->fetchAll();

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
                        DATE_FORMAT(date_create_at, "%d/%m/%Y") as dateCreate_at,
                        DATE_FORMAT(create_at, "%d/%m/%Y") as dateCreate,
                        idPosts,
                        idUsers
                FROM Comments
                INNER JOIN Posts on idPosts = post_commentId
                INNER JOIN Users on idUsers = user_commentId
                WHERE post_commentId = :idPosts
                ORDER BY dateCreate ASC LIMIT 0,10';

        $result = $this->getBdd()->prepare($req);
        $result->bindParam(":idPosts", $id);
        $result->execute();
        $commentPost = $result->fetchAll();

        return $commentPost;
    }

    public function findCommentById($id)
    {
        $bdd = $this->getBdd();
        $req = 'SELECT *,DATE_FORMAT(create_at, "%d/%m/%Y") as dateCreateAt 
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
     * @param Posts $post
     */
    public function editPost(Posts $post)
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
        $request->bindValue(':title', $post->getPostTitle());
        $request->bindValue(':content', $post->getPostContent());
        $request->bindValue(':images', $post->getImages());
        $request->bindValue(':link', $post->getLink());
        $request->bindValue(':idUser', $_SESSION['id_membre']);
        $request->execute();
    }

    /**
     * @param $post => $_Post
     * @return bool
     * @throws Exception
     */
    public function updatePost(Posts $post): bool
    {

        $bdd = $this->getBdd();
        $request = 'UPDATE Posts SET 
                                     postTitle = :title,
                                     postContent = :content, 
                                     images = :images, 
                                     date_create_at = NOW() 
                   WHERE idPosts = :idPosts';
        $result = $bdd->prepare($request);
        $result->bindValue(':title', $post->getPostTitle());
        $result->bindValue(':content', $post->getPostContent());
        $result->bindValue(':images', $post->getImages());
        $result->bindValue(':idPosts', $post->getIdPosts());


        return $result->execute();
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
