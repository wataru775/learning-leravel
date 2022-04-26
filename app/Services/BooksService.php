<?php

namespace App\Services;

use App\Classes\Book;
use App\Models\Book as BookModel;

class BooksService
{

    public function __construct(){
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

        return $currentBook;
    }
}
