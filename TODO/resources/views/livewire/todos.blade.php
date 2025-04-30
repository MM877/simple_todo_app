<?php

use function Livewire\Volt\{state, with};
use App\Models\Todo;


/*This creates a Livewire "state variable" called $task.

It holds what the user types in the input field.

*/
state(['task' => '']);

/*todos will automatically fetch all tasks for the currently logged-in user.

auth()->user()->todos assumes your User model has a todos() relationship.*/

with([
    'todos' => fn() => auth()->user()->todos
]);

$add = function() {
    /*
    First, it checks that:

The task is not empty (required)

It's at least 3 characters long
    */

    $this->validate([
        'task' => 'required|min:3'
    ]);


/*
Saves the new task in the todos table in the database.

Links it to the current user by using auth()->id().
*/
    Todo::create([
        'user_id' => auth()->id(),
        'task' => $this->task
    ]);

   // Resets the input box to empty after adding the task.
    $this->task = '';
};


$delete =fn(Todo $todo) => $todo->delete();
?>

<div>
    <form wire:submit.prevent="add" class="mb-4">
        <div class="flex gap-2">
            <!--
                It runs the $add function (defined above)
                prevent = don't reload the page
            -->
            <input type="text" wire:model="task" placeholder="Enter your task..." class="border p-2 rounded flex-1">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add</button>
        </div>
        @error('task') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
    </form>

    <div class="space-y-2">
        @foreach ($todos as $todo)
            <div class="p-3 bg-white rounded shadow">
                {{ $todo->task }}
                <button wire:click="delete({{ $todo->id }})" class="text-red-500 hover:text-red-700">Delete</button>
            </div>
        @endforeach
    </div>
</div>
