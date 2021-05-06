<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voidss
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('plan_id')->after('id')->unsigned()->nullable();
            $table->string('domain')->after('remember_token')->nullable();
            $table->string('subdomain')->after('domain')->nullable();
            $table->string('cover')->after('subdomain')->nullable();
            $table->string('facebook')->after('cover')->nullable();
            $table->string('facebook_pixel')->after('facebook')->nullable();
            $table->string('goole_analytics')->after('facebook_pixel')->nullable();
            $table->string('whatsapp')->after('goole_analytics')->nullable();
            $table->string('email_contact')->after('whatsapp')->nullable();
            $table->string('site_title')->after('email_contact')->nullable();
            $table->tinyInteger('status')->default('1')->after('site_title');
            $table->longText('site_keywords')->after('status')->nullable();
            $table->longText('site_description')->after('site_keywords')->nullable();
            $table->dateTime('expires_at')->after('site_description')->nullable();
            $table->dateTime('disabled_account_at')->after('expires_at')->nullable();            
            $table->dateTime('delete_account_at')->after('disabled_account_at')->nullable();            
            $table->softDeletes()->after('updated_at');
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
            //
        });
    }
}
