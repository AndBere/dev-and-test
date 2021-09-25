<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('status_id') ->unsigned() ->default(1);
            $table->integer('user_id') ->unsigned() ->nullable();
            $table->integer('admin_id') ->unsigned() ->nullable();
            $table->string('name', 191) ->collation('utf8mb4_unicode_ci');
            $table->string('phone', 191) ->collation('utf8mb4_unicode_ci');
            $table->string('email', 191) ->collation('utf8mb4_unicode_ci');
            $table->text('message') ->collation('utf8mb4_unicode_ci');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
