<?php


namespace Tests\Model;


use App\Entity\Posts;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function test(): void
    {
        $post = new Posts();

        $post->setTitle('titre');
        $this->assertEquals('titre', $post->getTitle());
        $post->setContent('content');
        $this->assertEquals('content', $post->getContent());
        $post->setTitle('Mardi');
        $this->assertEquals('Mardi', $post->getTitle());
        $post->setContent('prochain');
        $this->assertEquals('prochain', $post->getContent());
        $post->setIdPosts('3');
        $this->assertEquals('3', $post->getIdPosts());
    }
}
