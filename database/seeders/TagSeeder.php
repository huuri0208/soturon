<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         
         DB::table('tags')->insert([
                'title' => 'イルミネーション',
                'body' => '期間中、LEDのイルミネーションが国府宮参道の並木を美しく彩ります。

                           今回のテーマ「＃らぶりーでいず」に沿ってハートを取り入れたイルミネーションをはじめ、様々なイベントを用意していますので、皆さまのご参加をお待ちしています。',
               
         ]);
    }
}
