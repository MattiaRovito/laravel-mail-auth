<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //bisogna ora inserire la chiave esterna

            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            // N.B.: ogni volta che si crea qualcosa con update bisogna mettere o nullable o un valore di base. 

            // N.B.: after mi permette di aggiungere la nuova categoria subito dopo quella desiderata, in questo caso dopo id.

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //Inserisco il dropForeign, così facendo quando si fa il rollback bisogna essere nelle condizioni di eliminare la colonna.

            $table->dropForeign('category_id');
        });
    }
}
