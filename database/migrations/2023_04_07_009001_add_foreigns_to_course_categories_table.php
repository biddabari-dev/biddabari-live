<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('course_categories', function (Blueprint $table) {
//            $table
//                ->foreign('parent_id')
//                ->references('id')
//                ->on('course_categories')
//                ->onUpdate('CASCADE')
//                ->onDelete('CASCADE');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });
    }
};
