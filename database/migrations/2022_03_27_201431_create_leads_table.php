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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('attribution_key');
            $table->string('ip_hash');
            $table->string('user_agent_hash');
            $table->string('pixel_path');
            $table->string('visitor_id');
            $table->string('visit_id');
            $table->string('redirected_at');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('offer_id');
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
        Schema::dropIfExists('leads');
    }
};
