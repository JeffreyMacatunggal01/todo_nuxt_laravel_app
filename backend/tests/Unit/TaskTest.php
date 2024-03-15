<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase; // This trait resets the database after each test


    public function testTaskCreation()
    {
        // Create a new task
        $task = Task::factory()->create([
            'name' => 'Task 1',
            'description' => 'This is task 1',
            'status' => 'TODO'
        ]);

        // Assert that the task was created successfully
        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals('Task 1', $task->name);
        $this->assertEquals('This is task 1', $task->description);
        $this->assertEquals('TODO', $task->status);
    }

    public function testTaskUpdate()
    {
        // Create a new task
        $task = Task::factory()->create([
            'name' => 'Task 1',
            'description' => 'This is task 1',
            'status' => 'TODO'
        ]);

        // Update the task
        $task->name = 'Updated Task 1';
        $task->description = 'This is the updated task 1';
        $task->status = 'DONE';
        $task->save();

        // Assert that the task was updated successfully
        $this->assertEquals('Updated Task 1', $task->name);
        $this->assertEquals('This is the updated task 1', $task->description);
        $this->assertEquals('DONE', $task->status);
    }

    public function testTaskDeletion()
    {
        // Create a new task
        $task = Task::factory()->create([
            'name' => 'Task 1',
            'description' => 'This is task 1',
            'status' => 'TODO'
        ]);

        // Delete the task
        $task->delete();

        // Assert that the task was deleted successfully
        $this->assertDatabaseMissing($task->getTable(), ['id' => $task->id]);
    }
}
