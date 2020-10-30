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


    /**
     * BlogListController constructor.
     *
     */
    public function __construct()
    {
        $this->postModel = new PostsModel();
        $this->commentModel = new CommentsModel();
        $this->config = new Config();
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
        ]);
    }

    public function blogPost(string $slug, string $id): string
    {
        $post = $this->getConfig()->sanitize($_POST);

        $viewPost = $this->getPostModel()->findPostByIds($id);
        $commentByPost = $this->getPostModel()->findCommentsByPostAndIds($id);

        if(!empty($post)){
            return $this->addCommentToBlogPost($id);
        }

        return $this->getConfig()->render('layout.php', 'front/viewPost.php', [
            'titre' => 'l\'article '.$slug,
            'slug' => $slug,
            'id' => $id,
            'post' => $viewPost,
            'comments' => $commentByPost
        ]);
    }

    public function addCommentToBlogPost($id)
    {
        $post = $this->getConfig()->sanitize($_POST);
        $idPost= $id;
        $title = $post['commentTitle'];
        $comment =$post['Commentaire'];

        return $this->getPostModel()->addCommentToPost($idPost,$title,$comment);
    }

}
