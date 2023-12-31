<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->default(4);
            $table->string('name', 25);
            $table->string('username', 25);
            $table->text('user_dsc')->nullable();
            $table->string('gender' ,6)->nullable();
            $table->string('birthday')->nullable();
            $table->string('blood')->nullable();
            $table->string('mobile', 15)->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('mobile_verification_token')->nullable();
            $table->string('email', 50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token')->nullable();
            $table->string('password');
            $table->string('temp_password', 15)->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();

            $table->decimal('wallet_balance')->default(0.00);

            $table->string('shop_name', 255)->nullable();
            $table->string('nid_front', 255)->nullable();
            $table->string('nid_back', 255)->nullable();
            $table->string('trade_license', 255)->nullable();
            $table->string('trade_license2', 255)->nullable();
            $table->string('trade_license3', 255)->nullable();
            $table->integer('country')->nullable();
            $table->integer('region')->nullable();
            $table->integer('city')->nullable();
            $table->integer('area')->nullable();
            $table->string('address')->nullable();
            $table->decimal('referral_amount')->default(0);
            $table->integer('referral_by')->nullable();
            $table->integer('total_referral')->default(0);
            $table->string('photo', 225)->nullable();

            $table->timestamp('last_login')->nullable();
            $table->timestamp('join_date')->nullable();
            $table->tinyInteger('activation')->default(1);
            $table->timestamp('verify')->nullable();
            $table->string('status', 10)->default(1)->comment('active, pending');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
