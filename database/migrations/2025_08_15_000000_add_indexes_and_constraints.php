<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shopping_cart', function (Blueprint $table) {
            $table->index('user_id', 'shopping_cart_user_id_index');
            $table->index('product_id', 'shopping_cart_product_id_index');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->index('section_id', 'products_section_id_index');
        });

        if (Schema::hasTable('favorites')) {
            Schema::table('favorites', function (Blueprint $table) {
                $table->unique(['user_id', 'product_id'], 'favorites_user_product_unique');
            });
        }
    }

    public function down(): void
    {
        Schema::table('shopping_cart', function (Blueprint $table) {
            $table->dropIndex('shopping_cart_user_id_index');
            $table->dropIndex('shopping_cart_product_id_index');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_section_id_index');
        });

        if (Schema::hasTable('favorites')) {
            Schema::table('favorites', function (Blueprint $table) {
                $table->dropUnique('favorites_user_product_unique');
            });
        }
    }
};


