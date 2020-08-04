<?php


namespace Tests\Controller;


class BlogController
{
    public function blog(): string
    {
        return 'blog';
    }

    public function blogPost(string $id): string
    {
        return $id;
    }
}