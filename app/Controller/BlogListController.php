<?php


namespace App\Controller;


use App\Model\Model;

class BlogListController
{
   public function blogList(): string
   {
       $postAll = new Model();
       $listPost = $postAll->findAll();
       return "Voici tout mes articles";
   }

   public function blogByIds(string $id = "1", string $slug = "mes-articles"): string
   {
        return "$slug n°$id";
   }
}