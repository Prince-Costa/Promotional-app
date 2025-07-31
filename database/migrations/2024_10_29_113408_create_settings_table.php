<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // General settings
            $table->string('site_name')->default('Mt Management System CMH');
            $table->string('site_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('about_sec_title')->nullable();
            $table->longText('about_sec_one')->nullable();
            $table->longText('about_sec_two')->nullable();

            //social media link
            $table->string('twitter_link')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('instagram_link')->nullable();

            $table->tinyInteger('is_active_twitter')->nullable();
            $table->tinyInteger('is_active_fb')->nullable();
            $table->tinyInteger('is_active_linkedin')->nullable();
            $table->tinyInteger('is_active_instagram')->nullable();



            // Feature toggles
            $table->boolean('is_maintenance_mode')->default(false);
            $table->boolean('enable_user_registration')->default(true);
            $table->boolean('enable_footer')->default(false);
            $table->boolean('enable_developer_info')->default(false);

            //Texts
            $table->string('front_cover_text')->nullable();

            // Branding
            $table->string('logo_path')->nullable();
            $table->string('favicon_path')->nullable();

            // Images
            $table->string('banner')->nullable();
            $table->string('about_img_one')->nullable();
            $table->string('about_img_two')->nullable();

            $table->timestamps();
        });

        // Insert default settings values
        DB::table('settings')->insert([
            'site_name' => '',
            'site_email' => '',
            'phone_number' => '',
            'address' => '',
            'about_sec_title' => '',
            'about_sec_one' => '',
            'about_sec_two' => '',
            'twitter_link' => '',
            'fb_link' => '',
            'linkedin_link' => '',
            'instagram_link' => '',
            'is_active_twitter' => '1',
            'is_active_fb' => '1',
            'is_active_linkedin' => '1',
            'is_active_instagram' => '1',
            'is_maintenance_mode' => false,
            'enable_user_registration' => true,
            'enable_footer' => true,
            'enable_developer_info' => true,
            'front_cover_text' => '',
            'logo_path' => '',
            'favicon_path' => '',
            'banner' => '',
            'about_img_one' => '',
            'about_img_two' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
