<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\User;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create(['name' => 'テストユーザー']);
        }
        $userId = $user->id;

        $itemsData = [
            [
                'name' => '腕時計', 
                'price' => 15000, 
                'brand' => 'Rolax', 
                'description' => 'スタイリッシュなデザインのメンズ腕時計', 
                'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg', 
                'condition' => '良好',
            ],
            [
                'name' => 'HDD', 
                'price' => 5000, 
                'brand' => '西芝', 
                'description' => '高速で信頼性の高いハードディスク', 
                'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg', 
                'condition' => '目立った傷や汚れなし',
            ],
            [
                'name' => '玉ねぎ3束', 
                'price' => 300, 
                'brand' => 'なし', 
                'description' => '新鮮な玉ねぎ3束のセット', 
                'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg', 
                'condition' => 'やや傷や汚れあり',
            ],
            [
                'name' => '革靴', 
                'price' => 4000, 
                'brand' => 'なし', 
                'description' => 'クラシックなデザインの革靴', 
                'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg', 
                'condition' => '状態が悪い',
            ],
            [
                'name' => 'ノートPC', 
                'price' => 45000, 
                'brand' => 'なし', 
                'description' => '高性能なノートパソコン', 
                'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg', 
                'condition' => '良好',
            ],
            [
                'name' => 'マイク', 
                'price' => 8000, 
                'brand' => 'なし', 
                'description' => '高音質のレコーディング用マイク', 
                'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg', 
                'condition' => '目立った傷や汚れなし',
            ],
            [
                'name' => 'ショルダーバッグ', 
                'price' => 3500, 
                'brand' => 'なし', 
                'description' => 'おしゃれなショルダーバッグ', 
                'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg', 
                'condition' => 'やや傷や汚れあり',
            ],
            [
                'name' => 'タンブラー', 
                'price' => 500, 
                'brand' => 'なし', 
                'description' => '使いやすいタンブラー', 
                'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg', 
                'condition' => '状態が悪い',
            ],
            [
                'name' => 'コーヒーミル', 
                'price' => 4000, 
                'brand' => 'Starbacks', 
                'description' => '手動のコーヒーミル', 
                'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg', 
                'condition' => '良好',
            ],
            [
                'name' => 'メイクセット', 
                'price' => 2500, 
                'brand' => 'なし', 
                'description' => '便利なメイクアップセット', 
                'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg', 
                'condition' => '目立った傷や汚れなし',
            ],
        ];

        foreach ($itemsData as $data) {
            $categoryId = Category::where('name', $data['category'])->first()->id ?? null;
            $conditionId = Condition::where('name', $data['condition'])->first()->id ?? null;

            if ($categoryId && $conditionId) {
                Item::create([
                    'user_id' => $userId,
                    'category_id' => $categoryId,
                    'condition_id' => $conditionId,
                    'name' => $data['name'],
                    'brand' => $data['brand'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'img_url' => $data['image_url'],
                ]);
            }
        }
    }
}