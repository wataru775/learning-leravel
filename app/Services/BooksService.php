<?php

namespace App\Services;

use App\Models\Book as BookModel;

class BooksService
{

    public function __construct(){
    }

    /**
     * DBのタイトルを取得する
     * @param int $id 取得するDB ID
     * @return string|null タイトル
     */
    public function serve(int $id , bool $kakko = true) : ?string{
        $book = BookModel::find($id);

        // データが取れたかの判断
        if($book === null){
            // データが取れない場合の例外
            return null;
        }

        $title = $kakko ? ' 「 ' . $book->title . ' 」 ' : $book->title;

        return $title;
    }
}
