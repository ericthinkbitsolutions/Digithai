<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveExtensionFromCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('extension');
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('extension')->nullable()->after('address');
        });
    }
}

