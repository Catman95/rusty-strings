<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'phone',
        'zip_code',
        'city'
    ];

    public function insert_items($items, $order_id) {
        $rows = [];
        foreach ($items as $item){
            $product = \DB::table('products')->where('id', $item['id'])->first();
            array_push($rows, [
               'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'order_id' => $order_id,
                'price_then' => $product->price
            ]);
        }
        \DB::table('order_items')->insert($rows);
    }

    public function get_items($id) {
        try {
            $items = \DB::table('order_items')->where('order_id', $id)->get();
            foreach ($items as $item) {
                $itemName = \DB::table('products')->select('name')->where('id', $item->product_id)->first();
                $item->name = $itemName->name;
            }
            return $items;
        }catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
