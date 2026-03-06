<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['name' => 'Rahul Sharma', 'email' => 'rahul@college.edu', 'phone' => '9876543210'],
            ['name' => 'Priya Patel', 'email' => 'priya@college.edu', 'phone' => '9876543211'],
            ['name' => 'Amit Kumar', 'email' => 'amit@college.edu', 'phone' => '9876543212'],
            ['name' => 'Sneha Verma', 'email' => 'sneha@college.edu', 'phone' => '9876543213'],
            ['name' => 'Rohan Gupta', 'email' => 'rohan@college.edu', 'phone' => '9876543214'],
            ['name' => 'Anjali Singh', 'email' => 'anjali@college.edu', 'phone' => '9876543215'],
            ['name' => 'Karan Mehta', 'email' => 'karan@college.edu', 'phone' => '9876543216'],
            ['name' => 'Divya Nair', 'email' => 'divya@college.edu', 'phone' => '9876543217'],
        ];

        $statuses        = ['pending', 'confirmed', 'preparing', 'ready', 'delivered'];
        $paymentMethods  = ['upi', 'cash'];
        $paymentStatuses = ['pending', 'paid'];
        $menuItems       = MenuItem::all();

        for ($i = 1; $i <= 20; $i++) {
            $student       = $students[array_rand($students)];
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];
            $orderStatus   = $statuses[array_rand($statuses)];
            $paymentStatus = ($orderStatus === 'delivered') ? 'paid' : $paymentStatuses[array_rand($paymentStatuses)];

            $order = Order::create([
                'order_number'       => 'ORD' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'student_name'       => $student['name'],
                'student_email'      => $student['email'],
                'student_phone'      => $student['phone'],
                'payment_method'     => $paymentMethod,
                'payment_status'     => $paymentStatus,
                'order_status'       => $orderStatus,
                'total_amount'       => 0,
                'notes'              => rand(0, 1) ? 'Extra spicy please' : null,
                'upi_transaction_id' => ($paymentMethod === 'upi' && $paymentStatus === 'paid') ? 'UPI' . rand(100000, 999999) : null,
            ]);

            $total          = 0;
            $selectedItems  = $menuItems->random(rand(1, 3));
            foreach ($selectedItems as $item) {
                $qty      = rand(1, 3);
                $subtotal = $item->price * $qty;
                $total   += $subtotal;

                OrderItem::create([
                    'order_id'     => $order->id,
                    'menu_item_id' => $item->id,
                    'name'         => $item->name,
                    'price'        => $item->price,
                    'quantity'     => $qty,
                    'subtotal'     => $subtotal,
                ]);
            }

            $order->update(['total_amount' => $total]);
        }
    }
}