<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Posts;
use App\Entity\Users;
use App\Model\CommentsModel;
use App\Model\MembresModel;
use App\Model\PostsModel;
use Config\Config;

class BlogListController
{

    private CommentsModel $commentModel;
    private Config $config;
    private PostsModel $postModel;
    private MembresModel $membreModel;


    /**
     * BlogListController constructor.
     */
    public function __construct()
    {
        $this->postModel = new PostsModel();
        $this->commentModel = new CommentsModel();
        $this->config = new Config();
        $this->membreModel = new MembresModel();
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
        return $this -> membreModel;
    }

    /**
     * @return CommentsModel
     */
    public function getCommentModel(): CommentsModel
    {
        return $this -> commentModel;
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

        return $conf->render('layout.php', 'front/posts.php', [
            'titre' => 'Mes articles',
            'listPost' => $listPost
        ]);
    }

    /**
     * @param string $slug
     * @param string $id
     * @return bool|void
     */
    public function blogPost(string $slug, string $id): bool
    {
        $post = $this->getConfig()->sanitize($_POST);
        $viewPost = $this->getPostModel()->findPostByIds($id);
        $commentByPost = $this->getPostModel()->findCommentsByPostAndIds($id);
        foreach ($commentByPost as $postComment) {
            $idComment = $postComment->getIdComments();
        }
        if (!empty($post)) {
            $this->addCommentToBlogPost($id, $slug, $_SESSION['id_membre']);
        }

        return $this->getConfig()->render('layout.php', 'front/viewPost.php', [
            'titre' => 'l\'article '.$slug,
            'slug' => $slug,
            'id' => $id,
            'post' => $viewPost,
            'comments' => $commentByPost,
            'changer'=> 'Modifier'
        ]);
    }

    /**
     * @param $idPosts
     * @param $slug
     * @param $commentIds
     */
    public function addCommentToBlogPost($idPosts, $slug, $commentIds)
    {
        $post = $this->getConfig()->sanitize($_POST);
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
        $post = $this->getConfig()->sanitize($_POST);
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
        return $this->getConfig()->render("layout.php", "admin/postEdit.php", [
            'titre'=> 'Nouvel Article',
        ]);
    }

    /**
     * @param $idPost
     * @return bool
     */
    public function postFormById($idPost): bool
    {
        $postByIds = $this->getPostModel()->findPostByIds($idPost);
        $postImage = $postByIds->getImages();

        return $this->getConfig()->render("layout.php", "admin/postEdit.php", [
            'titre' => 'Modifier l\'article',
            'blog_actuel' => $postByIds,
            'blog_image' => $postImage
        ]);
    }

    /**
     * Add new Post
     */
    public function addPost()
    {
        $post = $this->getConfig()->sanitize($_POST);
        $newPost = new Posts();
        $this->copyImages();
        $post['images'] = $_POST['images'];
        $post['postUserId'] = $_SESSION['id_membre'];
        $newPost->hydrate($post);



        $this->getPostModel()->editPost($newPost);

        return $this->getConfig()->redirect("/blogs");
    }


    /**
     * Update post by blogger
     * @throws \Exception
     */
    public function updatePostById()
    {
        $post = $this->getConfig()->sanitize($_POST);
        if (!empty($post)) {
            $newPost = new Posts();
            $this->copyImages();
            $post['images'] = $_POST['images'];
            $newPost->hydrate($post);
            $this->getPostModel()->updatePost($newPost);

            return $this->getConfig()->redirect('/blogs');
        }
    }

    /**
     * Delete post by blogger
     */
    public function deletePostId()
    {
        $post = $this->getConfig()->sanitize($_POST);
        $this->getPostModel()->deletePost($post['idPost']);
        return $this->getConfig()->redirect('/blogs');
    }


    /**
     * Copy image in directory
     */
    public function copyImages()
    {
        $titleSpace = trim($_POST['postTitle']);
        $title = str_replace(" ", "_", $titleSpace);
        if (!empty($_FILES['images']['name'])) {
            $nom = $title.'-'.$_SESSION['id_membre'].'_'.$_FILES['images']['name'];
            $_POST['images'] = $nom;
            $pathPhoto = __DIR__ . '/../../public/images/' . $nom;
            move_uploaded_file($_FILES['images']['tmp_name'], $pathPhoto);
        }
    }
}
