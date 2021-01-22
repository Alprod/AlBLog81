<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Users;
use App\Model\CommentsModel;
use App\Model\ContactsModel;
use App\Model\MembresModel;
use App\Model\PostsModel;
use Config\Config;
use Config\PDOmanager;
use Config\Superglobal;

class AdminController extends PDOmanager
{
    /**
     * @var Config
     */
    private Config $config;

    /**
     * @var PostsModel
     */
    private PostsModel $postModel;

    /**
     * @var MembresModel
     */
    private MembresModel $membreModel;

    /**
     * @var CommentsModel
     */
    private CommentsModel $commentModel;

    /**
     * @var ContactsModel
     */
    private ContactsModel $contactsModel;

    /**
     * @var Superglobal
     */
    private Superglobal $superGlobal;

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this -> config = new Config();
        $this -> postModel = new PostsModel();
        $this -> membreModel = new MembresModel();
        $this -> commentModel = new CommentsModel();
        $this -> contactsModel = new ContactsModel();
        $this -> superGlobal = new Superglobal();
    }

    /**
     * @return Superglobal
     */
    public function getSuperGlobal(): Superglobal
    {
        return $this -> superGlobal;
    }


    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @return PostsModel
     */
    public function getPostModel(): PostsModel
    {
        return $this->postModel;
    }

    /**
     * @return mixed
     */
    public function getContactsModel()
    {
        return $this -> contactsModel;
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
     * @return bool
     */
    public function dashboardAdmin(): bool
    {
        $users = $this->getMembreModel()->findAll();
        $posts = $this->getPostModel()->findAllPosts();
        $comments = $this->getCommentModel()->findAllComments();
        $report = $this->getCommentModel()->findCommentsReport();
        $contactMail = $this->getContactsModel()->findAllMailContact();

        return $this->getConfig()->render("layout.php", "admin/dashboard.php", [
            'titre' => 'Dashbarod',
            'users' => $users,
            'posts' => $posts,
            'comments' => $comments,
            'reports' => $report,
            'mailContact' => $contactMail
        ]);
    }


    /**
     * Delete All member register
     */
    public function deletedMemberRegister()
    {
        $supeGolbal = $this->getSuperGlobal()->getPost();
        $post = $this->getConfig()->sanitize($supeGolbal);
        $user = new Users();
        $user->hydrate($post);

        if (!empty($post)) {
            $this->getMembreModel()->deleteMembersRegister($user);
        }

        return $this->getConfig()->redirect('/dashboard');
    }

    /**
     * Update a member (Admin|Blogger) to member
     */
    public function updateUserRegisterToMember()
    {
        $post = $_POST;
        $user = new Users();
        $user->hydrate($post);
        if (!empty($post)) {
            $this->getMembreModel()->updateUserToMembre($user);
        }
        return $this->getConfig()->redirect('/dashboard');
    }


    /**
     * Update a member (Admin|Memeber) to blogger
     */
    public function updateMemberRegisterToBlogger()
    {
        $post = $_POST;
        $user = new Users();
        $user->hydrate($post);
        if (!empty($post)) {
            $this->getMembreModel()->updateMembreToBlogger($user);
        }

        return $this->getConfig()->redirect('/dashboard');
    }

    /**
     * Update a member (Blogger|Memeber) to super admin
     */
    public function updateMemberRegisterToSuperAdmin()
    {
        $post = $_POST;
        $user = new Users();
        $user->hydrate($post);
        if (!empty($post)) {
            $this->getMembreModel()->updateMembreToSuperAdmin($user);
        }

        return $this->getConfig()->redirect('/dashboard');
    }


    /**
     * Delete comment not approved
     */
    public function deleteReportNotApprouved()
    {
        $post = $_POST;
        $report  = new Comments();
        $report->hydrate($post);

        $this->getCommentModel()->deleteComment($report);

        return $this->getConfig()->redirect("/dashboard");
    }


    /**
     * Update comment approuved by super admin
     */
    public function approuvedReport()
    {
        $post = $_POST;
        $report = new Comments();
        $report->hydrate($post);

        $this->getCommentModel()->updateCommentReport($report);

        return $this->getConfig()->redirect('/dashboard');
    }
}
