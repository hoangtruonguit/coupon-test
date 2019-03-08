<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned()->references('id')->on('members')->onDelete('cascade');
            $table->integer('coupon_id')->unsigned()->references('id')->on('coupons')->onDelete('cascade');
            $table->timestamp('used_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members_coupons');
    }
}
