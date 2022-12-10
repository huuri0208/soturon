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
                'title' => 'なつまつり',
                'body' => '木曽川の雄大な河川空間と全国でも稀な河岸砂丘である「祖父江砂丘」を有するサリオパーク祖父江を舞台として、8月27日（土曜）に『稲沢夏まつり2022』が開催されます。

　当日は、メインイベントとして、打ち上げ花火約3,000発と「尾張最大級のナイアガラ花火　市民の力で173.0（イナザワ）m」と題し、ナイアガラ花火を行います。',
               
         ]);
         
          DB::table('tags')->insert([
                'title' => 'イルミネーション',
                'body' => '期間中、LEDのイルミネーションが国府宮参道の並木を美しく彩ります。

                           今回のテーマ「＃らぶりーでいず」に沿ってハートを取り入れたイルミネーションをはじめ、様々なイベントを用意していますので、皆さまのご参加をお待ちしています。',
               
         ]);
         
          DB::table('tags')->insert([
                'title' => '祖父江ぎんなんパーク',
                'body' => '祖父江ぎんなんパークは、「祖父江ぎんなん」ブランドの強化・確立を図るために整備されました。
　代表的な4品種である久寿（きゅうじゅ）、藤九郎（とうくろう）、栄神（えいしん）、金兵衛（きんべえ）がすべて園内で見られ、世代を問わず交流や健康づくりができる魅力的な公園です。',
               
         ]);
         
    }
}
