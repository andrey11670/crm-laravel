<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\Course;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        Warehouse::factory(10)->create();
        product::factory(10)->create();
        stock::factory(10)->create();
        Order::factory(50)->create();
        Order_item::factory(250)->create();
        Course::factory(1)->create();


        $update = "
CREATE TRIGGER trigger_update AFTER UPDATE ON order_items
FOR EACH ROW
BEGIN
    INSERT INTO `movement_histories` (product_id, order_items_id, action, warehouse_id, created_at)
    SELECT NEW.product_id, NEW.id, 'updated', o.warehouse_id, NOW()
    FROM `orders` o
    WHERE o.id = NEW.order_id;
END";

        $create = "
CREATE TRIGGER trigger_create AFTER INSERT ON order_items
FOR EACH ROW
BEGIN
        INSERT INTO `movement_histories` (product_id, order_items_id, action, warehouse_id, created_at)
    SELECT NEW.product_id, NEW.id, 'create', o.warehouse_id, NOW()
    FROM `orders` o
    WHERE o.id = NEW.order_id;
END";
        $delete = "
CREATE TRIGGER trigger_delete AFTER DELETE ON order_items
FOR EACH ROW
BEGIN
        INSERT INTO `movement_histories` (product_id, order_items_id, action, warehouse_id, created_at)
    SELECT OLD.product_id, OLD.id, 'delete', o.warehouse_id, NOW()
    FROM `orders` o
    WHERE o.id = OLD.order_id;
END";
        DB::statement($update);
        DB::statement($create);
        DB::statement($delete);

    }
}
