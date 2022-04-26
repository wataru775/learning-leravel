<?php

namespace App\Classes;

/**
 * 書籍情報
 */
class Book
{
    /**
     * @var int 管理ID
     */
    public int $id;
    /**
     * @var string 書籍タイトル
     */
    public string $title;
    /**
     * @var string|null 著者名
     */
    public ?string $author = null;
}
