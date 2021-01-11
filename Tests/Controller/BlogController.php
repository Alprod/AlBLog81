<?php


namespace Tests\Controller;


class BlogController
{
    /**
     * @return string
     */
    public function blog(): string
    {
        return 'blog';
    }

    /**
     * @param string $slug
     * @param string $id
     * @return string
     */
    public function blogPost(string $slug, string $id): string
    {
        return "Mon article $slug n° $id";
    }
}