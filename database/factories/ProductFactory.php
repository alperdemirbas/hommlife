<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            'Nefes Tazeleyici Ağız Spreyi',
            'Siyah Karbon Diş Macunu',
            'Damla Sakızlı Diş Macunu',
            'Nane Aromalı Ağız Bakım Suyu',
            'Nemlendirici Krem',
            'Siyah Karbon Maske',
            'Avokado Özlü El Kremi',
            'Ayak Bakım Sprreyi',
            'Guarana Jel',
            'Beyazlatıcı Krem',
            'Simli Bronzlaştırıcı'

        ];

        return [
            'name' => $this->faker->randomElement($products),
            'price' => $this->faker->randomFloat(2, 100, 1000), // 10 ile 1000 TL arasında rastgele ondalık fiyat
            'code' => "P" . $this->faker->unique(1, 1000)->numberBetween(111, 999),
            'image' => 'https://placehold.co/150x100?text=Homm Life',
        ];
    }
}
