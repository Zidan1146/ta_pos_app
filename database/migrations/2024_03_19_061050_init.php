<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    private $prepareBuyTrigger = '
        CREATE TRIGGER `buyTrigger` AFTER INSERT ON `transactionTemps` FOR EACH ROW
        BEGIN
            UPDATE items SET quantity = quantity - NEW.count
            WHERE id = NEW.item_id;
        END
    ';

    private $prepareCancelTrigger = '
        CREATE TRIGGER `cancelTrigger` AFTER DELETE ON `transactionTemps` FOR EACH ROW
        BEGIN
            UPDATE items SET quantity = quantity + OLD.count
            WHERE id = OLD.item_id;
        END
    ';

    private $adminLoginTrigger = '
        CREATE TRIGGER `adminLoginTrigger` AFTER UPDATE ON `admin` FOR EACH ROW
        BEGIN
            IF NEW.status = "logged_in" THEN
                INSERT INTO logs (performer, tag, message, created_at, updated_at)
                VALUES (NEW.username, "admin_login", CONCAT(NEW.username, " logged in at ", NOW()), NOW(), NOW());
            END IF;
        END
    ';

    private $cashierInsertTrigger = '
        CREATE TRIGGER `cashierInsertTrigger` AFTER INSERT ON `cashier` FOR EACH ROW
        BEGIN
            INSERT INTO logs (performer, tag, message, created_at, updated_at)
            VALUES (NEW.username, "cashier_insert", CONCAT("New cashier added: ", NEW.username), NOW(), NOW());
        END
    ';

    private $cashierUpdateTrigger = '
        CREATE TRIGGER `cashierUpdateTrigger` AFTER UPDATE ON `cashier` FOR EACH ROW
        BEGIN
            INSERT INTO logs (performer, tag, message, created_at, updated_at)
            VALUES (NEW.username, "cashier_update", CONCAT("Cashier updated: ", NEW.username), NOW(), NOW());
        END
    ';

    private $cashierDeleteTrigger = '
        CREATE TRIGGER `cashierDeleteTrigger` AFTER DELETE ON `cashier` FOR EACH ROW
        BEGIN
            INSERT INTO logs (performer, tag, message, created_at, updated_at)
            VALUES (OLD.username, "cashier_delete", CONCAT("Cashier deleted: ", OLD.username), NOW(), NOW());
        END
    ';

    private $itemsInsertTrigger = '
        CREATE TRIGGER `itemsInsertTrigger` AFTER INSERT ON `items` FOR EACH ROW
        BEGIN
            INSERT INTO logs (performer, tag, message, created_at, updated_at)
            VALUES ("system", "items_insert", CONCAT("New item added: ", NEW.name), NOW(), NOW());
        END
    ';

    private $itemsUpdateTrigger = '
        CREATE TRIGGER `itemsUpdateTrigger` AFTER UPDATE ON `items` FOR EACH ROW
        BEGIN
            INSERT INTO logs (performer, tag, message, created_at, updated_at)
            VALUES ("system", "items_update", CONCAT("Item updated: ", NEW.name), NOW(), NOW());
        END
    ';

    private $itemsDeleteTrigger = '
        CREATE TRIGGER `itemsDeleteTrigger` AFTER DELETE ON `items` FOR EACH ROW
        BEGIN
            INSERT INTO logs (performer, tag, message, created_at, updated_at)
            VALUES ("system", "items_delete", CONCAT("Item deleted: ", OLD.name), NOW(), NOW());
        END
    ';

    private $dropBuyTrigger = 'DROP TRIGGER IF EXISTS `buyTrigger`';
    private $dropCancelTrigger = 'DROP TRIGGER IF EXISTS `cancelTrigger`';
    private $dropAdminLoginTrigger = 'DROP TRIGGER IF EXISTS `adminLoginTrigger`';
    private $dropCashierInsertTrigger = 'DROP TRIGGER IF EXISTS `cashierInsertTrigger`';
    private $dropCashierUpdateTrigger = 'DROP TRIGGER IF EXISTS `cashierUpdateTrigger`';
    private $dropCashierDeleteTrigger = 'DROP TRIGGER IF EXISTS `cashierDeleteTrigger`';
    private $dropItemsInsertTrigger = 'DROP TRIGGER IF EXISTS `itemsInsertTrigger`';
    private $dropItemsUpdateTrigger = 'DROP TRIGGER IF EXISTS `itemsUpdateTrigger`';
    private $dropItemsDeleteTrigger = 'DROP TRIGGER IF EXISTS `itemsDeleteTrigger`';

    public function up(): void
    {
        try {
            Schema::create("cashier", function (Blueprint $blueprint) {
                $blueprint->uuid("id")->primary();
                $blueprint->string("username");
                $blueprint->string("email");
                $blueprint->string("telephone-number");
                $blueprint->enum("gender", ["male", "female"]);
                $blueprint->string("password");
                $blueprint->string("address");

                $blueprint->timestamps();
            });

            Schema::create("admin", function (Blueprint $blueprint) {
                $blueprint->uuid("id")->primary();
                $blueprint->string("username");
                $blueprint->string("password");
                $blueprint->enum("status", ['logged_in', 'logged_out']);

                $blueprint->timestamps();
            });

            Schema::create("items", function (Blueprint $blueprint) {
                $blueprint->uuid("id")->primary();
                $blueprint->string("name");
                $blueprint->double("sellCost");
                $blueprint->double("buyCost");
                $blueprint->integer("quantity");
                $blueprint->string("description");

                $blueprint->timestamps();
            });

            Schema::create("transactionTemps", function (Blueprint $blueprint) {
                $blueprint->id("id");
                $blueprint->integer("count");
                $blueprint->double("cost");

                $blueprint->foreignUuid("item_id")->constrained();

                $blueprint->timestamps();
            });

            Schema::create("transaction", function (Blueprint $blueprint) {
                $blueprint->id("id");
                $blueprint->string("itemName");
                $blueprint->integer("count");
                $blueprint->double("cost");
                $blueprint->double("pay");
                $blueprint->dateTime("date");

                $blueprint->timestamps();
            });

            Schema::create("logs", function (Blueprint $blueprint) {
                $blueprint->id("id");

                $blueprint->string("performer");
                $blueprint->string("tag");
                $blueprint->string("message");
                $blueprint->timestamps();
            });

            DB::unprepared($this->prepareBuyTrigger);
            DB::unprepared($this->prepareCancelTrigger);
            DB::unprepared($this->adminLoginTrigger);
            DB::unprepared($this->cashierInsertTrigger);
            DB::unprepared($this->cashierUpdateTrigger);
            DB::unprepared($this->cashierDeleteTrigger);
            DB::unprepared($this->itemsInsertTrigger);
            DB::unprepared($this->itemsUpdateTrigger);
            DB::unprepared($this->itemsDeleteTrigger);

        } catch (\Illuminate\Database\QueryException $th) {
            Schema::dropIfExists("cashier");
            Schema::dropIfExists("admin");
            Schema::dropIfExists("transactionTemps");
            Schema::dropIfExists("transaction");
            Schema::dropIfExists("items");
            Schema::dropIfExists("logs");

            DB::unprepared($this->dropBuyTrigger);
            DB::unprepared($this->dropCancelTrigger);
            DB::unprepared($this->dropAdminLoginTrigger);
            DB::unprepared($this->dropCashierInsertTrigger);
            DB::unprepared($this->dropCashierUpdateTrigger);
            DB::unprepared($this->dropCashierDeleteTrigger);
            DB::unprepared($this->dropItemsInsertTrigger);
            DB::unprepared($this->dropItemsUpdateTrigger);
            DB::unprepared($this->dropItemsDeleteTrigger);

            throw $th;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("cashier");
        Schema::dropIfExists("admin");
        Schema::dropIfExists("transactionTemps");
        Schema::dropIfExists("transaction");
        Schema::dropIfExists("items");
        Schema::dropIfExists("logs");

        DB::unprepared($this->dropBuyTrigger);
        DB::unprepared($this->dropCancelTrigger);
        DB::unprepared($this->dropAdminLoginTrigger);
        DB::unprepared($this->dropCashierInsertTrigger);
        DB::unprepared($this->dropCashierUpdateTrigger);
        DB::unprepared($this->dropCashierDeleteTrigger);
        DB::unprepared($this->dropItemsInsertTrigger);
        DB::unprepared($this->dropItemsUpdateTrigger);
        DB::unprepared($this->dropItemsDeleteTrigger);
    }
};
