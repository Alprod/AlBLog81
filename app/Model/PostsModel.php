<?php /** @noinspection NullPointerExceptionInspection */


namespace App\Model;

use App\Entity\Posts;
use Config\PDOmanager;
use Exception;

class PostsModel extends PDOmanager
{

    /**
     * @return bool|array
     */
    public function findAllPosts()
    {
        $req = 'SELECT u.lastname,
                           u.pseudo,
                           p.idPosts, 
                           p.postTitle,
                           p.images,
                           p.postContent,
                           p.dateCreateAt,
                           p.postUserId
                           FROM Posts AS p
                           JOIN Users AS u
                           WHERE p.postUserId = u.idUsers
                           ORDER BY p.dateCreateAt DESC LIMIT 0,15';
        $resultat = $this->getBdd()->prepare($req);
        $resultat->execute();
        $resultat->setFetchMode(self::FETCH_CLASS, "App\Entity\Posts");
        $data = $resultat->fetchAll();
        $resultat->closeCursor();

        if (!$data) {
            return false;
        }

        return $data;
    }

    /**
     * @param $idPost
     * @return mixed
     */
    public function findPostByIds($idPost)
    {
        $req = 'SELECT p.*, u.pseudo
                FROM Posts AS p
                JOIN Users AS u ON u.idUsers = p.postUserId
                WHERE p.idPosts = :id_post';
        $result = $this->getBdd()->prepare($req);
        $result->bindParam(":id_post", $idPost);
        $result->execute();
        $result->setFetchMode(self::FETCH_CLASS, "App\Entity\Posts");
        $posts= $result->fetch();
        return $posts;
    }

    /**
     * @param $idPostUser
     * @return array
     */
    public function findPostsByIdUser($idPostUser): array
    {
        $req = 'SELECT *, DATE_FORMAT(dateCreateAt, "%d/%m/%Y") as dateCreateAt 
                FROM Posts 
                WHERE postUserId = :id_user';
        $result = $this->getBdd()->prepare($req);
        $result->bindParam(":id_user", $idPostUser);
        $result->execute();
        $result->setFetchMode(self::FETCH_CLASS, 'App\Entity\Posts');
        $posts= $result->fetchAll();
        $result->closeCursor();

        return $posts;
    }

    /**
     * @param $idCommentsPosts
     * @return array
     */
    public function findCommentsByPostAndIds($idCommentsPosts): array
    {
        $req = 'SELECT  c.idComments,
                        u.pseudo,
                        c.commentTitle,
                        c.commentContent,
                        c.signal,
                        p.dateCreateAt,
                        c.commentCreateAt AS commentCreateAt,
                        p.idPosts,
                        u.idUsers
                FROM Comments AS c
                INNER JOIN Posts AS p on p.idPosts = c.postCommentId
                INNER JOIN Users AS u on u.idUsers = c.userCommentId
                WHERE c.postCommentId = :idPosts
                ORDER BY c.commentCreateAt ASC LIMIT 0,10';

        $result = $this->getBdd()->prepare($req);
        $result->bindParam(":idPosts", $idCommentsPosts);
        $result->execute();
        $result->setFetchMode(self::FETCH_CLASS, 'App\Entity\Comments');
        $commentPost = $result->fetchAll();
        return $commentPost;
    }


    /**
     * @param $idComments
     * @return array
     */
    public function findCommentById($idComments): array
    {
        $bdd = $this->getBdd();
        $req = 'SELECT *,DATE_FORMAT(commentCreateAt, "%d/%m/%Y") as dateCreateAt 
                FROM Comments
                INNER JOIN Posts ON idPosts = postCommentId
                INNER JOIN Users ON idUsers = userCommentId 
                WHERE userCommentId = :id';
        $result = $bdd->prepare($req);
        $result->bindParam(':id', $idComments);
        $result->execute();
        $commentUser = $result->fetchAll();
        $result->closeCursor();
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
        $req = $bdd->prepare('INSERT INTO Comments (
                                                        commentTitle,
                                                        commentContent,
                                                        commentCreateAt,
                                                        postCommentId,
                                                        userCommentId)
                                                VALUES (
                                                        :title,
                                                        :contenu,
                                                        NOW(),
                                                        :idPost,
                                                        :idComments)');
        $req->bindParam(':title', $title);
        $req->bindParam(':contenu', $comment);
        $req->bindParam(':idPost', $postId);
        $req->bindParam(':idComments', $commentId);
        $req->execute();
        $req->closeCursor();
    }

    /**
     * @param Posts $post
     */
    public function editPost(Posts $post)
    {
        $bdd = $this->getBdd();
        $req = $bdd->prepare('INSERT INTO Posts (
                                                                postTitle,
                                                                postContent,
                                                                images,
                                                                link,
                                                                dateCreateAt,
                                                                postUserId)
                                                         VALUES (:title,
                                                                 :content,
                                                                 :images,
                                                                 :link,
                                                                 NOW(),
                                                                 :idUser)');
        $req->bindValue(':title', $post->getPostTitle());
        $req->bindValue(':content', $post->getPostContent());
        $req->bindValue(':images', $post->getImages());
        $req->bindValue(':link', $post->getLink());
        $req->bindValue(':idUser', $_SESSION['id_membre']);
        $req->execute();
        $req->closeCursor();
    }

    /**
     * @param Posts $post
     * @return bool
     * @throws Exception
     */
    public function updatePost(Posts $post): bool
    {

        $bdd = $this->getBdd();
        $req = 'UPDATE Posts SET 
                                 postTitle = :title,
                                 postContent = :content, 
                                 images = :images, 
                                 dateCreateAt = NOW() 
                   WHERE idPosts = :idPosts';
        $result = $bdd->prepare($req);
        $result->bindValue(':title', $post->getPostTitle());
        $result->bindValue(':content', $post->getPostContent());
        $result->bindValue(':images', $post->getImages());
        $result->bindValue(':idPosts', $post->getIdPosts());
        $result->closeCursor();
        return $result->execute();
    }

    /**
     * @param $idDeletePosts
     */
    public function deletePost($idDeletePosts)
    {
        $bdd = $this->getBdd();
        $req = $bdd->prepare('DELETE FROM Posts WHERE idPosts = :id');
        $req->bindParam(':id', $idDeletePosts);
        $req->execute();
        $req->closeCursor();
    }
}
