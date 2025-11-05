<?php

use App\Models\User;
use App\Models\Category;
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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Category::class);
            $table->string('title');
            $table->text('content'); // markdown formatting
            $table->text('summary'); // used in article cards
            $table->text('image')->nullable(); // link to resource, either by uploading to website or cross linking
            $table->timestamps();

            // indexes for search
            $table->index('category_id'); // category selection in nav
            $table->index('created_at'); // orderByDesc('created_at')
            //$table->fullText(['title', 'summary', 'content']); // get triggered in multiple LIKE searches
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
