<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_name'); // 新しく追加するユーザー名のカラム
            $table->unsignedBigInteger('customer_id'); // 顧客IDカラム
            $table->foreign('customer_id')->references('id')->on('customers'); // 顧客IDの外部キー制約
            $table->string('order_number')->unique();
            $table->text('details');
            $table->timestamps();
        });
    }
    

  /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['customer_id']); // 外部キー制約の削除
            $table->dropColumn('customer_id'); // カラムの削除
        });

        Schema::dropIfExists('orders');
    }
};
