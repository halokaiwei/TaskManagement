<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('tools_used');
            $table->enum('category', ['writing articles', 
            'assignment helping', 'Data Entry', 'Graphic Design', 
            'Web Development', 'Marketing', 'Research', 'Translation', 
            'Content Editing', 'Event Planning', 'Video Editing']); // Restricted task categories    
            $table->dateTime('due_date');    
            $table->foreignId('posted_by')->constrained('users'); // Reference to the admin who posted the task
            $table->foreignId('picked_up_by')->nullable()->constrained('users'); // Reference to the user who picked up the task
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
        Schema::dropIfExists('tasks');
    }
}
