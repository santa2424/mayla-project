<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Concealer1',      'category' => 'Concealer'],
            ['name' => 'Eyeshadow',       'category' => 'Eyeshadow'],
            ['name' => 'Lipstick1',       'category' => 'Lipstick'],
            ['name' => 'Lipstick2',       'category' => 'Lipstick'],
            ['name' => 'Lipstick3',       'category' => 'Lipstick'],
            ['name' => 'Makeup Brushes1', 'category' => 'Makeup Brushes'],
            ['name' => 'Makeup Brushes2', 'category' => 'Makeup Brushes'],
            ['name' => 'Mascara1',        'category' => 'Mascara'],
            ['name' => 'Mascara2',        'category' => 'Mascara'],
            ['name' => 'Mascara3',        'category' => 'Mascara'],
        ];

        // نختار أول مستخدم لإضافة المنتجات له (تأكدي إنو في مستخدم بقاعدة البيانات)
        $user = User::first();

        if (! $user) {
            $this->command->error("لا يوجد مستخدم في قاعدة البيانات! يرجى إنشاء مستخدم أولاً.");
            return;
        }

        foreach ($products as $productData) {
            $category = Category::where('name', $productData['category'])->first();
            if (! $category) {
                $this->command->warn("الفئة '{$productData['category']}' غير موجودة. تم تجاوز المنتج.");
                continue;
            }

            Product::create([
                'user_id'     => $user->id,
                'name'        => $productData['name'],
                'description' => 'Sample description for ' . $productData['name'],
                'price'       => rand(10, 100),
                'quantity'    => rand(5, 20),
                'image'       => $productData['name'] . '.jfif',
                'category_id' => $category->id,
            ]);
        }

        $this->command->info("✅ تم إنشاء المنتجات بنجاح.");
    }
}
