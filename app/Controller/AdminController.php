<?php


namespace App\Controller;

use App\Entity\Comments;
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
    
    public function getCommentModel()
    {
        return $this->commentModel;
    }


    /**
     * @return bool
     */
    public function dashbaordAdmin(): bool
    {
        $users = $this->getMembreModel()->findAll();
        $posts = $this->getPostModel()->findAllPosts();
        $comments = $this->getCommentModel()->findAllComments();
        $report = $this->getCommentModel()->findCommentsReport();

        return $this->getConfig()->render("layout.php", "admin/dashbaord.php", [
            'titre' => 'Dashbarod',
            'users' => $users,
            'posts' => $posts,
            'comments' => $comments,
            'reports' => $report
        ]);
    }

    public function deleteReportNotApprouved()
    {
        $post = $_POST;
        $report  = new Comments();
        $report->hydrate($post);

        $this->getCommentModel()->deleteComment($report);

        return $this->getConfig()->redirect("/dashbaord");
    }

    public function approuvedReport()
    {
        $post = $_POST;
        $report = new Comments();
        $report->hydrate($post);

        $this->getCommentModel()->updateCommentReport($report);

        return $this->getConfig()->redirect('/dashbaord');
    }
}
