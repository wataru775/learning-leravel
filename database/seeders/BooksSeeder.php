<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert(['title' => 'ドメイン特化言語 パターンで学ぶDSLのベストプラクティス46項目',]);
        DB::table('books')->insert(['title' => '３月のライオン(１３)',]);
        DB::table('books')->insert(['title' => 'ゼロから作るDeep Learning ―Pythonで学ぶディープラーニングの理論と実装',]);
        DB::table('books')->insert(['title' => 'WORLD END ECONOMiCA (2) (電撃文庫)',]);
        DB::table('books')->insert(['title' => 'WORLD END ECONOMiCA (3) (電撃文庫)',]);
    }
}
