<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('outfits', function (Blueprint $table) {
            $table->boolean('isPublic')->default(false)->after('clothing_item_ids');
        });
    }

    public function down()
    {
        Schema::table('outfits', function (Blueprint $table) {
            $table->dropColumn('isPublic');
        });
    }

};
