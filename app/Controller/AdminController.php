<?php


namespace App\Controller;

use App\Model\CommentsModel;
use App\Model\MembresModel;
use App\Model\PostsModel;
use Config\Config;
use Config\PDOmanager;

class AdminController extends PDOmanager
{
    private Config $config;
    private PostsModel $postModel;
    private MembresModel $membreModel;
    private CommentsModel $commentModel;

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this -> config = new Config();
        $this -> postModel = new PostsModel();
        $this -> membreModel = new MembresModel();
        $this -> commentModel = new CommentsModel();
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getPostModel()
    {
        return $this->postModel;
    }

    public function getMembreModel()
    {
        return $this->membreModel;
    }
    
    public function getCommentMoel()
    {
        return $this->commentModel;
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        $superAdmin = Config::SUPER_USERS_ADMIN;
        return isset($_SESSION['membre']) && $_SESSION['membre']['roles'] == $superAdmin;
    }

    /**
     * @return bool
     */
    public function dashbaordAdmin(): bool
    {
        $users = $this->getMembreModel()->findAll();
        $posts = $this->getPostModel()->findAllPosts();
        $comments = $this->getCommentMoel()->findAllComments();

        return $this->getConfig()->render("layout.php", "admin/dashbaord.php", [
            'titre' => 'Dashbarod',
            'users' => $users,
            'posts' => $posts,
            'comments' => $comments
        ]);
    }
}
