<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->boolean('is_main')->default(false);
            $table->timestamps();
        });

        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->text('comment');
            $table->tinyInteger('rating');
            $table->timestamps();
        });


       $admin =  Role::create(['name' => 'admin', 'guard_name' => 'web']);
       $moderator =  Role::create(['name' => 'moderator', 'guard_name' => 'web']);

        $adminUser = new User([
            'name' => 'Admin', 'email' => 'admin@test.com', 'password' => Hash::make(123456)
        ]);
        $adminUser->save();

        $moderatorUser = new User([
            'name' => 'Moderator',
            'email' => 'moderator@test.com',
            'password' => Hash::make(123456)
        ]);
        $moderatorUser->save();

        $adminUser->assignRole($admin);
        $moderatorUser->assignRole($moderator);
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_category');
        Schema::dropIfExists('comments');
    }
};
