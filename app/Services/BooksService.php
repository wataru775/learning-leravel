<?php

namespace App\Services;

use App\Repositories\BooksRepository;

class BooksService
{

    public BooksRepository $booksRepository;

    public function __construct(BooksRepository $repository){
        $this->booksRepository = $repository;
    }

    /**
     * DBのタイトルを取得する
     * @param int $id 取得するDB ID
     * @return string|null タイトル
     */
    public function serveTitle(int $id , bool $kakko = true) : ?string{
        $book = $this->booksRepository->find($id);

        // データが取れているかの判断
        if($book === null){
            // 取れていない場合はnullを返す
            return null;

        }
        $title = $kakko ? ' 「 ' . $book->title . ' 」 ' : $book->title;

        return $title;
    }
}
