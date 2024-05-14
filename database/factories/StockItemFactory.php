<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\StockItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockItem>
 */
class StockItemFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sizes = Size::pluck('id');
        $colors = Color::pluck('id');
        $products = Product::pluck('id');

        return [
            'size_id'    => $sizes->random(),
            'color_id'   => $colors->random(),
            'product_id' => $products->random(),
            'quantity'   => $this->faker->numberBetween(1, 100),
        ];
    }
}