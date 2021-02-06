<?php


namespace App\Controller;

use App\Entity\Users;
use App\Model\MembresModel;
use App\Model\PostsModel;
use Config\Config;
use Config\Superglobal;
use DateTime;
use DateTimeZone;
use Exception;

class HomeController extends Config
{
    private MembresModel $membreModel;
    private PostsModel $postModel;
    private Superglobal $sessionUser;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->membreModel = new MembresModel();
        $this->postModel = new PostsModel();
        $this->sessionUser = new Superglobal();
    }

    /**
     * @return MembresModel
     */
    public function getMembreModel(): MembresModel
    {
        return $this -> membreModel;
    }

    /**
     * @return Superglobal
     */
    public function getSessionUser(): Superglobal
    {
        return $this -> sessionUser;
    }

    /**
     * @return PostsModel
     */
    public function getPostModel(): PostsModel
    {
        return $this -> postModel;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function index(): string
    {
        $idMember = $this->getSessionUser()->getSession('id_membre');
        $laDateDuJour = $this->dateOfTheDay();
        $heure = new DateTime('now', new DateTimeZone('EUROPE/Paris'));
        $heureDuJour = $heure->format('H:i');
        $calendarChinese = $this->calendarChinese(date('Y'));
        $user = $this->getMembreModel()->find($idMember);
        $lastPosts = $this->getPostModel()->displayPostsHomePage();

        $params = array(
            'titre'           =>  'Home page',
            'laDateDuJour'    =>  $laDateDuJour,
            'heureDuJour'     =>  $heureDuJour,
            'calendarChinese' =>  $calendarChinese,
            'membreUser'      =>  $user,
            'lastPost'        =>  $lastPosts,
            'success'         =>  'Salut '

        );

        return $this->render('layout.php', 'base.php', $params);
    }

    /**
     * @param $year
     * @return string|null
     */
    public function calendarChinese($year): string
    {
        switch ($year % 12) :
            case 0:
                return 'Singe / Monkey / 猴';
            case 1:
                return 'Coq / Rooster / 公鸡';
            case 2:
                return 'Chien / Dog / 狗';
            case 3:
                return 'Sanglier / Boar / 公猪';
            case 4:
                return 'Rat / 鼠';
            case 5:
                return 'Vache / Ox / 牛';
            case 6:
                return 'Tigre / Tiger / 虎';
            case 7:
                return 'Lapin / Rabit / 兔子';
            case 8:
                return 'Dragon / 龙';
            case 9:
                return 'Snake';
            case 10:
                return 'Cheval / Horse / 马';
            case 11:
                return 'Agneau / Lamb / 羊肉';
        endswitch;
    }

    /**
     * @return string
     */
    public function dateOfTheDay() : string
    {
        setlocale(LC_ALL, 'fr_FR');
        $date = date('l j F Y');
        $dateFormat = strftime("%A %d %B %G", strtotime($date));

        return $dateFormat;
    }
}
