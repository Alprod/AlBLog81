<?php


namespace Router\Tests\Fixtures;


class BlogController
{
    public function blog()
    {
        return 'blog';
    }

    public function blogPost(string $id){
        return $id;
    }
}