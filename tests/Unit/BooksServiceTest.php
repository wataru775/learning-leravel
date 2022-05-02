<?php

namespace Tests\Unit;

use App\Services\BooksService;
use App\Services\SearchAuthorService;
use Tests\TestCase;
use Mockery;
use Exception;

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
        $authorService = Mockery::mock(SearchAuthorService::class);
        $authorService
            ->shouldReceive('search')
            ->with('ドメイン特化言語 パターンで学ぶDSLのベストプラクティス46項目')
            ->andReturn('マーチン ファウラー');
        $authorService
            ->shouldReceive('search')
            ->with('３月のライオン(１３)')
            ->andReturn('羽海野チカ');
        $authorService
            ->shouldReceive('search')
            ->andReturn('不明');

        $booksService = new BooksService($authorService);

        $book = $booksService->serve(1);
        $this->assertEquals(' 「 ドメイン特化言語 パターンで学ぶDSLのベストプラクティス46項目 」 ' , $book->title);
        $this->assertEquals('マーチン ファウラー', $book->author);

        $book = $booksService->serve(1 , false);
        $this->assertEquals('ドメイン特化言語 パターンで学ぶDSLのベストプラクティス46項目' , $book->title);
        $this->assertEquals('マーチン ファウラー', $book->author);

        $booksService = new BooksService($authorService);
        $book = $booksService->serve(2);
        $this->assertEquals(' 「 ３月のライオン(１３) 」 ' , $book->title);
        $this->assertEquals('羽海野チカ' , $book->author);

        $booksService = new BooksService($authorService);
        $book = $booksService->serve(3);
        $this->assertEquals(' 「 ゼロから作るDeep Learning ―Pythonで学ぶディープラーニングの理論と実装 」 ' , $book->title);
        $this->assertEquals('不明' , $book->author);
    }
    public function test_service_exception(){
        // サービスを作成します
        $authorService = Mockery::mock(SearchAuthorService::class);
        $authorService
            ->shouldReceive('search')
            ->andThrow(new Exception('不明'));

        $booksService = new BooksService($authorService);
        $book = $booksService->serve(1);
        $this->assertEquals(' 「 ドメイン特化言語 パターンで学ぶDSLのベストプラクティス46項目 」 ' , $book->title);
        $this->assertEquals(null , $book->author);
    }
    /**
     * サービスの範囲外の試験
     */
    public function test_over(){
        // サービスを作成します
        $authorService = new SearchAuthorService();
        $booksService = new BooksService($authorService);

        $book = $booksService->serve(999);
        $this->assertNull($book , '範囲外の場合はnullとなります');

        $book = $booksService->serve(0);
        $this->assertNull($book , '値が0の場合はnullとなります');

        $book = $booksService->serve(-999 );
        $this->assertNull($book, 'マイナスの場合はnullとなります');
    }
}
