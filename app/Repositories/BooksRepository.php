<?php

namespace App\Repositories;

use App\Classes\Book;
use App\Models\Book as BookModel;

/**
 * 書籍情報操作リポジトリ
 */
class BooksRepository
{
    /**
     * 書籍情報を取得します
     * @param $id int 書籍Key
     * @return Book|null 書籍情報
     */
    public function find(int $id) : ?Book
    {
        $db_book = BookModel::find($id);

        // データが取れたかの判断
        if($db_book === null){
            // データが取れない場合の例外
            return null;
        }
        // 返却
        return $this->convertBookModelToObject($db_book);
    }

    /**
     * Modelクラスから内部のオブジェクトへ変換します
     * @param BookModel $book_model Model
     * @return Book 書籍情報
     */
    public function convertBookModelToObject(BookModel $book_model) : Book{
        $book =  new Book();
        $book->id = $book_model->id;
        $book->title = $book_model->title;

        return $book;
    }

}
