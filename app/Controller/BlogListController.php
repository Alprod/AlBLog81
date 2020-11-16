<?php

namespace App\Controller;

use App\Model\CommentsModel;
use App\Model\PostsModel;
use Config\Config;

class BlogListController
{

    private CommentsModel $commentModel;
    private Config $config;
    private PostsModel $postModel;
    private bool $isAdmin;


    /**
     * BlogListController constructor.
     *
     */
    public function __construct()
    {
        $this->postModel = new PostsModel();
        $this->commentModel = new CommentsModel();
        $this->config = new Config();
        $this->isAdmin = (new MembreController)->isAdmin();
    }

    /**
     * @return mixed
     */
    public function getPostModel()
    {
        return $this->postModel;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }



    public function blogList(): string
    {
        $listPost = $this->getPostModel()->findAllPosts();
        $conf = $this->getConfig();

        return $conf->render('layout.php', 'front/posts.php', [
            'titre' => 'Mes articles',
            'listPost' => $listPost,
            'isAdmin' => $this->isAdmin
        ]);
    }

    /**
     * @param string $slug
     * @param string $id
     * @return bool|void
     */
    public function blogPost(string $slug, string $id)
    {
        $post = $this->getConfig()->sanitize($_POST);

        $viewPost = $this->getPostModel()->findPostByIds($id);
        $commentByPost = $this->getPostModel()->findCommentsByPostAndIds($id);

        if(!empty($post)) $this->addCommentToBlogPost($id, $_SESSION['id_membre']);


        return $this->getConfig()->render('layout.php', 'front/viewPost.php', [
            'titre' => 'l\'article '.$slug,
            'slug' => $slug,
            'id' => $id,
            'post' => $viewPost,
            'comments' => $commentByPost
        ]);
    }

    public function addCommentToBlogPost($id, $commentIds)
    {
        $post = $this->getConfig()->sanitize($_POST);
        $idPost= $id;
        $commentId = $commentIds;
        $title = $post['commentTitle'];
        $comment =$post['Commentaire'];

        return $this->getPostModel()->addCommentToPost($commentId,$idPost,$title,$comment);
    }


    public function edit()
    {
        return $this->getConfig()->render("layout.php", "admin/postEdit.php", [
            'titre'=> 'Nouvel Article'
        ]);
    }


    public function addPost()
    {
        $post = $this->getConfig()->sanitize($_POST);
        $title = $post['titlePost'];
        $content = $post['contenuPost'];
        $link = $post['linkPost'];
        $this->copyImages();
        $photo = $_POST['photo'];

        $this->getPostModel()->editPost($title,$content,$photo,$link);

        return $this->getConfig()->redirect("/blogs");
    }

    public function copyImages()
    {
        $titleSpace = trim($_POST['titlePost']);
        $title = str_replace(" ", "_",$titleSpace);
        $file = $_FILES;
        if(!empty($_FILES['photo']['name'])){
            $nom = $title.'-'.$_SESSION['id_membre'].'_'.$_FILES['photo']['name'];
            $_POST['photo'] = $nom;
            $pathPhoto = __DIR__ . '/../../public/images/' . $nom;
            move_uploaded_file($_FILES['photo']['tmp_name'],$pathPhoto);
        }
    }

}
