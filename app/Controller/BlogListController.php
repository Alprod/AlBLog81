<?php

namespace App\Controller;

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
     *
     */
    public function __construct()
    {
        $this->postModel = new PostsModel();
        $this->commentModel = new CommentsModel();
        $this->config = new Config();
        $this->membreModel = new MembresModel();
        $this->isAdmin = (new MembreController)->isAdmin();
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
    private bool $isAdmin;



    /**
     * @return mixed
     */
    public function getConfig(): Config
    {
        return $this->config;
    }


    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * @return string
     */
    public function blogList(): string
    {
        $listPost = $this->getPostModel()->findAllPosts();

        $isAdmin = $this->isAdmin();
        $conf = $this->getConfig();

        return $conf->render('layout.php', 'front/posts.php', [
            'titre' => 'Mes articles',
            'listPost' => $listPost,
            'isAdmin' => $isAdmin
        ]);
    }

    /**
     * @param string $slug
     * @param string $id
     * @return bool|void
     */
    public function blogPost(string $slug, string $id): bool
    {
        $isAdmin = $this->isAdmin();
        $post = $this->getConfig()->sanitize($_POST);
        $viewPost = $this->getPostModel()->findPostByIds($id);
        $commentByPost = $this->getPostModel()->findCommentsByPostAndIds($id);

        if (!empty($post)) {
            $this->addCommentToBlogPost($id, $slug, $_SESSION['id_membre']);
        }

        return $this->getConfig()->render('layout.php', 'front/viewPost.php', [
            'titre' => 'l\'article '.$slug,
            'slug' => $slug,
            'id' => $id,
            'post' => $viewPost,
            'comments' => $commentByPost,
            'changer'=> 'Modifier',
            'isAdmin' => $isAdmin
        ]);
    }


    public function addPost()
    {
        $post = $this->getConfig()->sanitize($_POST);
        $newPost = new Posts();
        $this->copyImages();
        $post['images'] = $_POST['images'];
        $newPost->hydrate($post);


        $this->getPostModel()->editPost($newPost);

        return $this->getConfig()->redirect("/blogs");
    }

    /**
     * @param $id
     * @param $slug
     * @param $commentIds
     */
    public function addCommentToBlogPost($id, $slug, $commentIds)
    {
        $post = $this->getConfig()->sanitize($_POST);
        $idPost= $id;
        $commentId = $commentIds;
        $title = $post['commentTitle'];
        $comment =$post['Commentaire'];

        $this->getPostModel()->addCommentToPost($commentId, $idPost, $title, $comment);

        return $this->getConfig()->redirect("/$slug/$id");
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
     * @param $id
     * @return bool
     */
    public function postFormById($id): bool
    {
        $post = $this->getConfig()->sanitize($_POST);
        $postByIds = $this->getPostModel()->findPostByIds($id);
        foreach ($postByIds as $postById) {
            $idPost = $postById;
        }
        $postImage = $idPost->getImages();

        return $this->getConfig()->render("layout.php", "admin/postEdit.php", [
            'titre' => 'Modifier l\'article',
            'blog_actuel' => $idPost,
            'blog_image' => $postImage
        ]);
    }


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

    public function deletePostId()
    {
        $post = $this->getConfig()->sanitize($_POST);
        $this->getPostModel()->deletePost($post['idPost']);
        return $this->getConfig()->redirect('/blogs');
    }


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
