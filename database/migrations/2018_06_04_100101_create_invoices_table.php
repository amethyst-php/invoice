<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Config::get('ore.invoice.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('country');
            $table->string('locale');
            $table->string('currency');
            $table->integer('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on(Config::get('ore.taxonomy.table'));
            $table->integer('sender_id')->unsigned()->nullable();
            $table->foreign('sender_id')->references('id')->on(Config::get('ore.legal-entity.table'));
            $table->integer('recipient_id')->unsigned();
            $table->foreign('recipient_id')->references('id')->on(Config::get('ore.legal-entity.table'));
            $table->integer('tax_id')->unsigned()->nullable();
            $table->foreign('tax_id')->references('id')->on(Config::get('ore.tax.table'));
            $table->date('issued_at')->nullable();
            $table->date('expires_at')->nullable();
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
        Schema::dropIfExists(Config::get('ore.invoice.table'));
    }
}
