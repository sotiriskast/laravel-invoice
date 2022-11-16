<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class ReduceSizeOfIndexColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function ($table) {
            $table->string('model_type', 161)->change();
            $table->longText('manipulations')->change();
            $table->longText('custom_properties')->change();
            $table->longText('generated_conversions')->change();
            $table->longText('responsive_images')->change();
        });
        Schema::table('model_has_permissions', function ($table) {
            $table->string('model_type', 161)->change();
        });
        Schema::table('model_has_roles', function ($table) {
            $table->string('model_type', 161)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media', function ($table) {
            $table->string('model_type', 255)->change();
            $table->json('manipulations')->change();
            $table->json('custom_properties')->change();
            $table->json('generated_conversions')->change();
            $table->json('responsive_images')->change();
        });
        Schema::table('model_has_permissions', function ($table) {
            $table->string('model_type', 255)->change();
        });
        Schema::table('model_has_roles', function ($table) {
            $table->string('model_type', 255)->change();
        });
    }
}
