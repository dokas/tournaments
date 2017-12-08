<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('login')->after('id');
            $table->string('surname')->nullable()->after('name');
            $table->string('date_of_birth')->nullable()->after('surname');
            $table->enum('sex', array('man', 'woman'))->after('date_of_birth');
            $table->string('country')->nullable()->after('sex');
            $table->text('about')->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('login');
            $table->dropColumn('surname');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('sex');
            $table->dropColumn('country');
            $table->dropColumn('about');
        });
    }
}
