<?php

namespace Tests\Unit;

use App\Services\BooksService;
use Tests\TestCase;

/**
 * 書籍情報サービスを試験します
 */
class BooksServiceTest extends TestCase
{
    public function setup(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->seed('BooksSeeder');
    }

    /**
     * サービスの正常操作試験
     */
    public function test_service(){
        // サービスを作成します
        $booksService = new BooksService();

        $title = $booksService->serve(1);
        $this->assertEquals(' 「 ドメイン特化言語 パターンで学ぶDSLのベストプラクティス46項目 」 ' , $title);

        $title = $booksService->serve(1 , false);
        $this->assertEquals('ドメイン特化言語 パターンで学ぶDSLのベストプラクティス46項目' , $title);

        $title = $booksService->serve(2);
        $this->assertEquals(' 「 ３月のライオン(１３) 」 ' , $title);
    }

    /**
     * サービスの範囲外の試験
     */
    public function test_over(){
        // サービスを作成します
        $booksService = new BooksService();

        $title = $booksService->serve(999);
        $this->assertNull($title , '範囲外の場合はnullとなります');

        $title = $booksService->serve(0);
        $this->assertNull($title , '値が0の場合はnullとなります');

        $title = $booksService->serve(-999 );
        $this->assertNull($title, 'マイナスの場合はnullとなります');
    }
}
