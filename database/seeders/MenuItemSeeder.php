<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\Category;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $breakfast = Category::where('name', 'Breakfast')->first()->id;
        $meals     = Category::where('name', 'Meals')->first()->id;
        $snacks    = Category::where('name', 'Snacks')->first()->id;
        $beverages = Category::where('name', 'Beverages')->first()->id;
        $desserts  = Category::where('name', 'Desserts')->first()->id;
        $fastfood  = Category::where('name', 'Fast Food')->first()->id;

        $items = [
            // Breakfast
            ['category_id' => $breakfast, 'name' => 'Masala Dosa', 'description' => 'Crispy rice crepe with spiced potato filling, served with sambar and chutneys', 'price' => 45, 'is_veg' => true, 'preparation_time' => 10, 'is_featured' => true, 'available' => true],
            ['category_id' => $breakfast, 'name' => 'Idli Sambar (3 pcs)', 'description' => 'Soft steamed rice cakes served with hot sambar and coconut chutney', 'price' => 30, 'is_veg' => true, 'preparation_time' => 5, 'is_featured' => false, 'available' => true],
            ['category_id' => $breakfast, 'name' => 'Poha', 'description' => 'Flattened rice cooked with onions, peanuts and spices', 'price' => 25, 'is_veg' => true, 'preparation_time' => 7, 'is_featured' => false, 'available' => true],
            ['category_id' => $breakfast, 'name' => 'Aloo Paratha', 'description' => 'Whole wheat flatbread stuffed with spiced potato, served with curd and pickle', 'price' => 40, 'is_veg' => true, 'preparation_time' => 12, 'is_featured' => true, 'available' => true],
            ['category_id' => $breakfast, 'name' => 'Upma', 'description' => 'Semolina porridge with vegetables and tempering', 'price' => 25, 'is_veg' => true, 'preparation_time' => 8, 'is_featured' => false, 'available' => true],

            // Meals
            ['category_id' => $meals, 'name' => 'Veg Thali', 'description' => 'Dal, 2 sabzi, rice, roti, salad, and pickle', 'price' => 80, 'is_veg' => true, 'preparation_time' => 15, 'is_featured' => true, 'available' => true],
            ['category_id' => $meals, 'name' => 'Chicken Thali', 'description' => 'Chicken curry, rice, roti, salad, and pickle', 'price' => 110, 'is_veg' => false, 'preparation_time' => 20, 'is_featured' => true, 'available' => true],
            ['category_id' => $meals, 'name' => 'Rajma Chawal', 'description' => 'Red kidney bean curry served with steamed basmati rice', 'price' => 70, 'is_veg' => true, 'preparation_time' => 10, 'is_featured' => false, 'available' => true],
            ['category_id' => $meals, 'name' => 'Chole Bhature', 'description' => 'Spicy chickpea curry with two fluffy deep-fried breads', 'price' => 65, 'is_veg' => true, 'preparation_time' => 12, 'is_featured' => true, 'available' => true],
            ['category_id' => $meals, 'name' => 'Egg Rice', 'description' => 'Fried rice with scrambled eggs and vegetables', 'price' => 75, 'is_veg' => false, 'preparation_time' => 15, 'is_featured' => false, 'available' => true],

            // Snacks
            ['category_id' => $snacks, 'name' => 'Samosa (2 pcs)', 'description' => 'Crispy pastry filled with spiced potatoes and peas', 'price' => 20, 'is_veg' => true, 'preparation_time' => 5, 'is_featured' => true, 'available' => true],
            ['category_id' => $snacks, 'name' => 'Vada Pav', 'description' => 'Mumbai-style spiced potato fritter in a soft bun', 'price' => 20, 'is_veg' => true, 'preparation_time' => 5, 'is_featured' => true, 'available' => true],
            ['category_id' => $snacks, 'name' => 'Bread Pakora', 'description' => 'Bread slices dipped in gram flour batter and deep fried', 'price' => 25, 'is_veg' => true, 'preparation_time' => 7, 'is_featured' => false, 'available' => true],
            ['category_id' => $snacks, 'name' => 'Maggi Noodles', 'description' => 'Classic instant noodles with masala and veggies', 'price' => 30, 'is_veg' => true, 'preparation_time' => 8, 'is_featured' => false, 'available' => true],
            ['category_id' => $snacks, 'name' => 'Pav Bhaji', 'description' => 'Spiced mashed vegetables served with butter toasted buns', 'price' => 50, 'is_veg' => true, 'preparation_time' => 10, 'is_featured' => true, 'available' => true],

            // Beverages
            ['category_id' => $beverages, 'name' => 'Masala Chai', 'description' => 'Spiced milk tea with ginger and cardamom', 'price' => 15, 'is_veg' => true, 'preparation_time' => 5, 'is_featured' => true, 'available' => true],
            ['category_id' => $beverages, 'name' => 'Cold Coffee', 'description' => 'Chilled blended coffee with ice cream', 'price' => 40, 'is_veg' => true, 'preparation_time' => 5, 'is_featured' => true, 'available' => true],
            ['category_id' => $beverages, 'name' => 'Mango Lassi', 'description' => 'Thick yogurt-based mango drink', 'price' => 35, 'is_veg' => true, 'preparation_time' => 5, 'is_featured' => false, 'available' => true],
            ['category_id' => $beverages, 'name' => 'Fresh Lime Soda', 'description' => 'Refreshing lime soda, sweet or salted', 'price' => 25, 'is_veg' => true, 'preparation_time' => 3, 'is_featured' => false, 'available' => true],
            ['category_id' => $beverages, 'name' => 'Buttermilk', 'description' => 'Chilled spiced buttermilk with curry leaves', 'price' => 20, 'is_veg' => true, 'preparation_time' => 3, 'is_featured' => false, 'available' => true],

            // Desserts
            ['category_id' => $desserts, 'name' => 'Gulab Jamun (2 pcs)', 'description' => 'Soft milk-solid dumplings soaked in rose sugar syrup', 'price' => 25, 'is_veg' => true, 'preparation_time' => 5, 'is_featured' => true, 'available' => true],
            ['category_id' => $desserts, 'name' => 'Kheer', 'description' => 'Creamy rice pudding with cardamom and dry fruits', 'price' => 30, 'is_veg' => true, 'preparation_time' => 5, 'is_featured' => false, 'available' => true],
            ['category_id' => $desserts, 'name' => 'Rasgulla (2 pcs)', 'description' => 'Spongy cottage cheese balls in light sugar syrup', 'price' => 25, 'is_veg' => true, 'preparation_time' => 5, 'is_featured' => false, 'available' => true],

            // Fast Food
            ['category_id' => $fastfood, 'name' => 'Veg Burger', 'description' => 'Crispy veggie patty with lettuce, tomato in a toasted bun', 'price' => 55, 'is_veg' => true, 'preparation_time' => 10, 'is_featured' => true, 'available' => true],
            ['category_id' => $fastfood, 'name' => 'Chicken Burger', 'description' => 'Grilled chicken patty with mayo and fresh veggies', 'price' => 75, 'is_veg' => false, 'preparation_time' => 12, 'is_featured' => true, 'available' => true],
            ['category_id' => $fastfood, 'name' => 'Paneer Sandwich', 'description' => 'Grilled sandwich with cottage cheese and capsicum', 'price' => 45, 'is_veg' => true, 'preparation_time' => 8, 'is_featured' => false, 'available' => true],
            ['category_id' => $fastfood, 'name' => 'French Fries', 'description' => 'Crispy golden fries with ketchup', 'price' => 35, 'is_veg' => true, 'preparation_time' => 8, 'is_featured' => false, 'available' => true],
        ];

        foreach ($items as $item) {
            MenuItem::create($item);
        }
    }
}