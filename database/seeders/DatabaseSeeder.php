<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Stock\Entities\Stock;
use Modules\User\Entities\User;
use Modules\Stock\Entities\StockTransaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->email = "josep.tambunan7@gmail.com";
        $user->name = "Josep Tambunan";
        $user->phone = "085939076971";
        $user->password = bcrypt("123");
        $user->save();

        $stock = new Stock;
        $stock->name = "Product A";
        $stock->sku = "SKU A";
        $stock->stock = 30;
        $stock->save();

        $stock_transaction = new StockTransaction;
        $stock_transaction->stock_id = $stock->id;
        $stock_transaction->user_id = $user->id;
        $stock_transaction->stock = 30;
        $stock_transaction->created_at = date("Y-m-d H:i:s");
        $stock_transaction->save();
    }
}
