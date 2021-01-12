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
     * @param string $idPost
     * @return string
     */
    public function blogPost(string $slug, string $idPost): string
    {
        return "Mon article $slug n° $idPost";
    }
}