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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('product_name');
          
         $table->foreign('category_id')->references('id')->on('categories');
            $table->string('desc')->default('some description');
            $table->float('price')->default(0);
        
=======
            $table->foreignId('category_id')->constrained()->nullable();
            $table->string('product_name');
            $table->string('desc')->default('some description');
            $table->float('price')->default(0);
>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
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
        Schema::dropIfExists('products');
    }
};
