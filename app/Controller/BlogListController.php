<?php


namespace App\Controller;


class BlogListController
{
   public function blogList(): string
   {
       return "Voici tout mes articles";
   }

   public function blogByIds(string $id = "1", string $slug = "mes-articles"): string
   {
        return "$slug n°$id";
   }
}