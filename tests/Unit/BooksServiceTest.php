<?php

namespace Tests\Unit;

use App\Repositories\BooksRepository;
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
        $repository = new BooksRepository();
        $booksService = new BooksService($repository);

        $title = $booksService->serveTitle(1);
        $this->assertEquals(' 「 ドメイン特化言語 パターンで学ぶDSLのベストプラクティス46項目 」 ' , $title);

        $title = $booksService->serveTitle(1 , false);
        $this->assertEquals('ドメイン特化言語 パターンで学ぶDSLのベストプラクティス46項目' , $title);

        $title = $booksService->serveTitle(2);
        $this->assertEquals(' 「 ３月のライオン(１３) 」 ' , $title);
    }

    /**
     * サービスの範囲外の試験
     */
    public function test_over(){
        // サービスを作成します
        $repository = new BooksRepository();
        $booksService = new BooksService($repository);

        $title = $booksService->serveTitle(999);
        $this->assertNull($title , '範囲外の場合はnullとなります');

        $title = $booksService->serveTitle(0);
        $this->assertNull($title , '値が0の場合はnullとなります');

        $title = $booksService->serveTitle(-999 );
        $this->assertNull($title, 'マイナスの場合はnullとなります');
    }
}
