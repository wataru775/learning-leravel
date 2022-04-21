<?php

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function setup(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->seed('BooksSeeder');
    }

    /**
     * 直接DB参照できること
     */
    public function test_direct_access()
    {
        $book = Book::find(1);

        $this->assertEquals('ドメイン特化言語 パターンで学ぶDSLのベストプラクティス46項目' , $book->title);
    }
}
