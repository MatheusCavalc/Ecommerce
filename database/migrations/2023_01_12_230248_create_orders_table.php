<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_price', 20, 2);
            $table->string('products');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('address1', 255);
            $table->string('address2', 255)->nullable();
            $table->string('city', 255);
            $table->string('state', 45)->nullable();
            $table->string('zipcode', 45);

            $table->string('status_payment', 45)->nullable();
            $table->foreignIdFor(User::class, 'created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
