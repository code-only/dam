<?php

use App\Models\Asset;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->uuid('asset_id')->nullable()->unique();
            $table->foreignIdFor(User::class, 'user_id');
            $table->string('filename')->nullable();
            $table->string('filepath');
            $table->string('thumbnail')->nullable();
            $table->string('file_type');
            $table->string('asset_type');
            $table->boolean('is_private');
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('assets_usage', function (Blueprint $table) {
           $table->foreignIdFor(Asset::class, 'asset_id');
           $table->string('reference_link');
           $table->foreignIdFor(User::class, 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
        Schema::dropIfExists('assets_usage');
    }
};
