<?php


namespace Tests\Model;


use App\Model\Posts;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function test(): void
    {

        $post = new Posts('titre', 'content');
        $this->assertEquals('titre', $post->getTitle());
        $this->assertEquals('content', $post->getContent());
        $post->setTitle('Mardi');
        $this->assertEquals('Mardi', $post->getTitle());
        $post->setContent('prochain');
        $this->assertEquals('prochain', $post->getContent());
        $post->setId('3');
        $this->assertEquals('3', $post->getId());
    }
}
