<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(Config::get('amethyst.invoice.data.invoice.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('number')->nullable();
            $table->string('country');
            $table->string('locale');
            $table->string('currency');
            $table->integer('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on(Config::get('amethyst.taxonomy.data.taxonomy.table'));
            $table->integer('sender_id')->unsigned()->nullable();
            $table->foreign('sender_id')->references('id')->on(Config::get('amethyst.legal-entity.data.legal-entity.table'));
            $table->integer('recipient_id')->unsigned();
            $table->foreign('recipient_id')->references('id')->on(Config::get('amethyst.legal-entity.data.legal-entity.table'));
            $table->integer('tax_id')->unsigned()->nullable();
            $table->foreign('tax_id')->references('id')->on(Config::get('amethyst.tax.data.tax.table'));
            $table->date('issued_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(Config::get('amethyst.invoice.data.invoice-container.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('invoice_id')->unsigned();
            $table->foreign('invoice_id')->references('id')->on(Config::get('amethyst.invoice.data.invoice.table'));
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(Config::get('amethyst.invoice.data.invoice-item.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->float('price');
            $table->float('quantity');
            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on(Config::get('amethyst.taxonomy.data.taxonomy.table'));
            $table->integer('invoice_container_id')->unsigned();
            $table->foreign('invoice_container_id')->references('id')->on(Config::get('amethyst.invoice.data.invoice-container.table'));
            $table->integer('invoice_id')->unsigned();
            $table->foreign('invoice_id')->references('id')->on(Config::get('amethyst.invoice.data.invoice.table'));
            $table->integer('tax_id')->unsigned()->nullable();
            $table->foreign('tax_id')->references('id')->on(Config::get('amethyst.tax.data.tax.table'));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(Config::get('amethyst.invoice.data.invoice.table'));
        Schema::dropIfExists(Config::get('amethyst.invoice.data.invoice-item.table'));
        Schema::dropIfExists(Config::get('amethyst.invoice.data.invoice-container.table'));
    }
}
