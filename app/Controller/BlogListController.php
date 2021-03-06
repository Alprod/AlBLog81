<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Posts;
use App\Entity\Users;
use App\Model\CommentsModel;
use App\Model\MembresModel;
use App\Model\PostsModel;
use Config\Config;
use Config\Superglobal;
use Exception;

class BlogListController
{
    private CommentsModel $commentModel;
    private Config $config;
    private PostsModel $postModel;
    private MembresModel $membreModel;
    private Superglobal $superGlobal;


    /**
     * BlogListController constructor.
     */
    public function __construct()
    {
        $this->postModel = new PostsModel();
        $this->commentModel = new CommentsModel();
        $this->config = new Config();
        $this->membreModel = new MembresModel();
        $this->superGlobal = new Superglobal();
    }

    /**
     * @return Superglobal
     */
    public function getSuperGlobal(): Superglobal
    {
        return $this->superGlobal;
    }

    /**
     * @return mixed
     */
    public function getPostModel(): PostsModel
    {
        return $this->postModel;
    }

    /**
     * @return MembresModel
     */
    public function getMembreModel(): MembresModel
    {
        return $this->membreModel;
    }

    /**
     * @return CommentsModel
     */
    public function getCommentModel(): CommentsModel
    {
        return $this->commentModel;
    }



    /**
     * @return mixed
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @return string
     */
    public function blogList(): string
    {
        $listPost = $this->getPostModel()->findAllPosts();
        $conf = $this->getConfig();

        return $conf->render(
            'layout.php',
            'front/posts.php',
            [
            'titre' => 'Mes articles',
            'listPost' => $listPost
            ]
        );
    }

    /**
     * @param  string $slug
     * @param  string $id
     * @return bool|void
     */
    public function blogPost(string $slug, string $id): bool
    {
        $supeGolbal = $this->getSuperGlobal()->getPost();
        $sessionId = $this->getSuperGlobal()->getSession('id_membre');
        $post = $this->getConfig()->sanitize($supeGolbal);
        $viewPost = $this->getPostModel()->findPostByIds($id);
        $commentByPost = $this->getPostModel()->findCommentsByPostAndIds($id);
        if (!empty($post)) {
            $this->addCommentToBlogPost($id, $slug, $sessionId);
        }

        return $this->getConfig()->render(
            'layout.php',
            'front/viewPost.php',
            [
            'titre' => 'l\'article '.$slug,
            'slug' => $slug,
            'id' => $id,
            'post' => $viewPost,
            'comments' => $commentByPost,
            'changer'=> 'Modifier'
            ]
        );
    }

    /**
     * @param $idPosts
     * @param $slug
     * @param $commentIds
     */
    public function addCommentToBlogPost($idPosts, $slug, $commentIds)
    {
        $supeGolbal = $this->getSuperGlobal()->getPost();
        $post = $this->getConfig()->sanitize($supeGolbal);
        $idPost= $idPosts;
        $commentId = $commentIds;
        $title = $post['commentTitle'];
        $comment =$post['Commentaire'];

        $this->getPostModel()->addCommentToPost($commentId, $idPost, $title, $comment);

        return $this->getConfig()->redirect("/$slug/$idPosts");
    }


    /**
     * Update Comment signal by member
     */
    public function updateSignalCommentById()
    {
        $supeGolbal = $this->getSuperGlobal()->getPost();
        $post = $this->getConfig()->sanitize($supeGolbal);
        $comment = new Comments();
        $comment->hydrate($post);

        $findComment = $this->getCommentModel()->findCommentsById($comment->getIdComments());
        $slug = $findComment->getPostId()->getPostTitle();
        $idPost = $findComment->getPostId()->getIdPosts();

        if (empty($comment->getSignal())) {
            $this->getCommentModel()->updateSignal($comment);
        }

        return $this->getConfig()->redirect("/$slug/$idPost");
    }


    /**
     * @return bool
     */
    public function form()
    {
        return $this->getConfig()->render(
            "layout.php",
            "admin/postEdit.php",
            [
            'titre'=> 'Nouvel Article',
            ]
        );
    }

    /**
     * @param  $id
     * @return bool
     */
    public function postFormById($id)
    {
        $postByIds = $this->getPostModel()->findPostByIds($id);
        $postImage = $postByIds->getImages();

        return $this->getConfig()->render(
            "layout.php",
            "admin/postEdit.php",
            [
            'titre' => 'Modifier l\'article',
            'blog_actuel' => $postByIds,
            'blog_image' => $postImage
            ]
        );
    }

    /**
     * Add new Post
     */
    public function addPost()
    {
        $supeGolbal = $this->getSuperGlobal()->getPost();
        $post = $this->getConfig()->sanitize($supeGolbal);
        $newPost = new Posts();
        $newPost->hydrate($post);
        $newPost = $this->copyImages($newPost);

        $newPost->getPostUserId();
        $this->getPostModel()->editPost($newPost);

        return $this->getConfig()->redirect("/blogs");
    }


    /**
     * Update post by blogger
     *
     * @throws Exception
     */
    public function updatePostById()
    {
        $supeGolbal = $this->getSuperGlobal()->getPost();
        $post = $this->getConfig()->sanitize($supeGolbal);
        if (!empty($post)) {
            $newPost = new Posts();
            $newPost->hydrate($post);
            $newPost = $this->copyImages($newPost);
            $this->getPostModel()->updatePost($newPost);

            return $this->getConfig()->redirect('/blogs');
        }
    }

    /**
     * Delete post by blogger
     */
    public function deletePostId()
    {
        $supeGolbal = $this->getSuperGlobal()->getPost();
        $post = $this->getConfig()->sanitize($supeGolbal);
        $this->getPostModel()->deletePost($post['idPost']);
        return $this->getConfig()->redirect('/blogs');
    }

    public static function cleanName(string $name)
    {
        $deleteSpaceStartEnd = trim($name);
        $deleteSpaceInString = str_replace(" ", "_", $deleteSpaceStartEnd);

        return $deleteSpaceInString;
    }


    /**
     * Copy image in directory
     *
     * @param  $post
     * @return mixed
     */
    public function copyImages($post)
    {
        $userId = (int) $_SESSION['id_membre'];

        $fileBaseName = (string) $_FILES['images']['name'];
        $fileError = $_FILES['images']['error'];
        $tmpName = (string) $_FILES['images']['tmp_name'];

        $postTitle = $this->getSuperGlobal()->getPost('postTitle');
        $title = self::cleanName($postTitle);

        if (!empty($fileBaseName) && $fileError === 0) {
            $infoFile = pathinfo($fileBaseName);
            $extention_upload = $infoFile['extension'];
            $extensionAuth = ['jpg', 'jpeg', 'gif', 'png'];
            $fileName = $infoFile['filename'];
            $newName = substr_replace($fileName, $title, 0);

            if (in_array($extention_upload, $extensionAuth)) {
                $nom = 'user-id_'.$userId.'_'.$newName.'.'.$extention_upload;
                $post->setImages($nom);
                $pathPhoto = __DIR__ . '/../../public/images/' . $nom;
                move_uploaded_file($tmpName, $pathPhoto);
            }
        }
        return $post;
    }
}
