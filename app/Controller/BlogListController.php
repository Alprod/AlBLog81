<?php


namespace App\Controller;


use App\Model\Model;
use Config\Config;


class BlogListController
{


    public function blogList(): string
   {
       $postAll = new Model();
       $config = new Config();
       $listPost = $postAll->findAll();

       return $config->render("layout.php","posts.php", array(
           "listPost" => $listPost
       ));
   }

   public function blogByIds(string $id = "1", string $slug = "mes-articles"): string
   {
        return "$slug n°$id";
   }
}