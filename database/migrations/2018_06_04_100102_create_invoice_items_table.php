<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Config::get('ore.invoice-item.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->float('price');
            $table->float('quantity');
            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on(Config::get('ore.taxonomy.table'));
            $table->integer('invoice_id')->unsigned();
            $table->foreign('invoice_id')->references('id')->on(Config::get('ore.invoice.table'));
            $table->integer('tax_id')->unsigned()->nullable();
            $table->foreign('tax_id')->references('id')->on(Config::get('ore.tax.table'));
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
        Schema::dropIfExists(Config::get('ore.invoice-item.table'));
    }
}
