<?php

namespace App\Services;

use Exception;

/**
 * 著者情報取得サービス
 */
class SearchAuthorService
{
    /**
     * 書籍タイトルから著者を検索します
     * @param string $title 書籍タイトル
     * @return string|null 著者名
     * @throws Exception 何らかの例外
     */
    public function search(string $title) : ?string {
        return null;
    }
}
