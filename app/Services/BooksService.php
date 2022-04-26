<?php

namespace App\Services;

use App\Classes\Book;
use App\Models\Book as BookModel;
use Exception;
use Illuminate\Support\Facades\Log;

class BooksService
{
    /**
     * @var SearchAuthorService 著者情報検索サービス
     */
    private SearchAuthorService $authorService;

    public function __construct(SearchAuthorService $authorService){
        $this->authorService = $authorService;
    }

    /**
     * DBのタイトルを取得する
     * @param int $id 取得するDB ID
     * @return Book|null 書籍情報
     */
    public function serve(int $id , bool $kakko = true) : ?Book{
        $book = BookModel::find($id);

        // データが取れたかの判断
        if($book === null){
            // データが取れない場合の例外
            return null;
        }

        $currentBook = new Book();

        $currentBook->title = $kakko ? ' 「 ' . $book->title . ' 」 ' : $book->title;

        try {
            // 著者情報を取得します
            $currentBook->author = $this->authorService->search($book->title);
        } catch (Exception $e) {
            Log::debug($e);
        }

        return $currentBook;
    }
}
