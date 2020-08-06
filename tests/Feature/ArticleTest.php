<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInsert()
    {
        $article = factory(\App\Article::class, 1)->make([
            'title' => 'Unit Test',
        ]);
        return $this->assertDatabaseHas('articles', [
            'title' => 'Unit Test',
        ]);
    }
}
