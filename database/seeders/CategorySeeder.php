<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Vozidla', 'icon' => '<i class="bi bi-car-front-fill"></i>'],
            ['category_name' => 'Zvieratá', 'icon' => '<i class="fa-solid fa-paw"></i>'],
            ['category_name' => 'Elektronika', 'icon' => '<i class="bi bi-phone-fill"></i>'],
            ['category_name' => 'Domácnosť', 'icon' => '<i class="bi bi-house-door-fill"></i>'],
            ['category_name' => 'Šport', 'icon' => '<i class="fa-solid fa-basketball"></i>'],
            ['category_name' => 'Hračky', 'icon' => '<i class="bi bi-joystick"></i>'],
            ['category_name' => 'Hry', 'icon' => '<i class="bi bi-controller"></i>'],
            ['category_name' => 'Hudba', 'icon' => '<i class="bi bi-music-note-beamed"></i>'],
            ['category_name' => 'Oblečenie', 'icon' => '<i class="fa-solid fa-shirt"></i>'],
            /* ['category_name' => 'Rodina', 'icon' => '<i class="bi bi-people-fill"></i>'], */
            ['category_name' => 'Zábava', 'icon' => '<i class="bi bi-emoji-smile-fill"></i>'],
            ['category_name' => 'Záhrada', 'icon' => '<i class="bi bi-flower1"></i>'],
            ['category_name' => 'Zdarma', 'icon' => '<i class="bi bi-gift-fill"></i>'],
        ];
        
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

