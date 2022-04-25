<?php

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;

/**
 * Seederがちゃんと動いているかの試験
 */
class SeederTest extends TestCase
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
        $this->assertNotNull($book,'データが取れること');
        $this->assertEquals(1 , $book->id , 'データが取れること');
        $this->assertEquals('ドメイン特化言語 パターンで学ぶDSLのベストプラクティス46項目' , $book->title , 'データが取れること');

        $book = Book::find(2);
        $this->assertNotNull($book,'データが取れること');
        $this->assertEquals(2 , $book->id , '2番目のデータが取れること');
        $this->assertEquals('３月のライオン(１３)' , $book->title , '2番目のデータが取れること');

        $book = Book::find(999);
        $this->assertNull($book,'範囲外はNull');
    }
}
