<?php


namespace Router\Tests\Model;


use App\Model\Post;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function test(){

        $post = new Post('title', 'content');
        $this->assertEquals('title', $post->getTitle());
        $this->assertEquals('content', $post->getContent());
        $post->setTitle('Mardi');
        $this->assertEquals('Mardi', $post->getTitle());
        $post->setContent('prochain');
        $this->assertEquals('prochain', $post->getContent());
        $post->setId('3');
        $this->assertEquals('3', $post->getId());
    }
}
