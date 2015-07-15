<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePostcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postcode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('postcode')->index();
            $table->smallInteger('pnum')->unsigned();
            $table->char('pchar');
            $table->mediumInteger('minnumber')->index()->unsigned();
            $table->mediumInteger('maxnumber')->index()->unsigned();
            $table->enum('numbertype', array('', 'mixed', 'even', 'odd'));
            $table->string('street');
            $table->string('city');
            $table->string('municipality');
            $table->smallInteger('municipality_id');
            $table->decimal('lat', 15, 13);
            $table->decimal('lon', 15, 13);
            $table->decimal('rd_x', 31, 20);
            $table->decimal('rd_y', 31, 20);
            $table->enum('location_detail', array('','exact','postcode','pnum','city'));
            $table->timestamp('changed_date');

            DB::raw('UPDATE postcode
            INNER JOIN municipalities ON municipalities.name = postcode.municipality
            SET postcode.municipality_id = municipalities.id');

            $table->dropColumn('municipality');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('postcode');
    }
}
