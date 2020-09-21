<?php


namespace Tests\Controller;


class BlogController
{
    public function blog(): string
    {
        return 'blog';
    }

    public function blogPost(string $slug, string $id): string
    {
        return "Mon article $slug n° $id";
    }
}