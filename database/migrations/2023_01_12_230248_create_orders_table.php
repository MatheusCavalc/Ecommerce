<?php

use App\Models\User;
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

            //PURCHASE INFOS
            $table->decimal('total_price', 20, 2);
            $table->longText('products');

            //SHIPPING INFOS
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('address1', 255);
            $table->string('address2', 255)->nullable();
            $table->string('city', 255);
            $table->string('state', 45)->nullable();
            $table->string('zipcode', 45);

            //STATUS PAYMENT
            $table->enum('status_payment', ['PENDING', 'PAID', 'FAILED'])->default('PENDING');

            //PAYMENT ID (ON STRIPE)
            $table->longText('stripe_payment_id')->nullable();

            //OWNER ORDER
            $table->foreignIdFor(User::class, 'created_by');

            //OWNER EMAIL
            $table->string('email')->nullable();

            //STATUS SHIPPING
            $table->enum('status_shipping', ['PENDING', 'ON_SHIPPING'])->nullable();

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
