<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('user_id')
                  ->constrained()->nullOnDelete();
        });
    }
    public function down(): void {
        Schema::table('products', fn ($t) => $t->dropConstrainedForeignId('category_id'));
        Schema::dropIfExists('categories');
    }
};