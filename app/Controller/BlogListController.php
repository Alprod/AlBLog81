<?php

namespace App\Controller;

use App\Model\PostsModel;
use Config\Config;

class BlogListController
{

    private PostsModel $model;
    private Config $config;


    /**
     * BlogListController constructor.
     *
     */
    public function __construct()
    {
        $this->model = new PostsModel();
        $this->config = new Config();
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
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
        $listPost = $this->getModel()->findAllPosts();
        $conf = $this->getConfig();


        return $this->getConfig()->render('layout.php', 'posts.php', [
            'listPost' => $listPost,
            'url' => $conf->assets($listPost["images"])
        ]);
    }

    public function blogPost(string $slug, string $id): string
    {
        $viewPost = $this->getModel()->findPostByIds($id);
        return $this->getConfig()->render('layout.php', 'viewPost.php', [
            'slug' => $slug,
            'id' => $id,
            'post' => $viewPost
        ]);
    }

    public function deleteSapceWord ($word)
    {
        $replaced = str_replace(' ', '', $word);
        return $replaced;
    }

}
