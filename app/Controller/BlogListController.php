<?php

namespace App\Controller;

use App\Model\Model;
use Config\Config;

class BlogListController
{

    private Model $model;
    private Config $config;


    /**
     * BlogListController constructor.
     *
     */
    public function __construct()
    {
        $this->model = new Model();
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
        $listPost = $this->getModel()->findAll();

        return $this->getConfig()->render('layout.php', 'posts.php', [
            'listPost' => $listPost,
        ]);
    }

    public function blogPost(string $slug, string $id): string
    {
        return $this->getConfig()->render('layout.php', 'viewPost.php', [
            'slug' => $slug,
            'id' => $id
        ]);
    }

    public function deleteSapceWord ($word)
    {
        $replaced = str_replace(' ', '', $word);
        return $replaced;
    }

}
