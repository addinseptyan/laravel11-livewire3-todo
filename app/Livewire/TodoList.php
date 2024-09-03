<?php

namespace App\Livewire;

use App\Models\Todo;
use Exception;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    #[Rule('required|min:3|max:50')]
    public $name;

    public $search;

    public $editingTodoId;

    #[Rule('required|min:3|max:50')]
    public $editingTodoName;

    public function create()
    {
        // validate
        // create todo
        // clear input
        // send flash message

        $validated = $this->validateOnly('name');

        Todo::create($validated);

        $this->reset('name');

        session()->flash('success', 'Created.');

        // for move to 1st page
        $this->resetPage();
    }

    public function delete($todoId)
    {
        try {
            Todo::findOrFail($todoId)->delete();
        } catch (Exception $e) {
            session()->flash('error', 'Failed to delete Todo.');
            return;
        }
    }

    public function toggle($todoId)
    {
        $todo = Todo::find($todoId);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function edit($todoId)
    {
        $this->editingTodoId = $todoId;
        $this->editingTodoName = Todo::find($todoId)->name;

        // for remove error validation when editing
        $this->resetErrorBag();
    }

    public function cancelEditing()
    {
        $this->reset('editingTodoId', 'editingTodoName');

        // for remove error validation when editing
        $this->resetErrorBag();
    }

    public function update()
    {
        $this->validateOnly('editingTodoName');

        Todo::find($this->editingTodoId)->update([
            'name' => $this->editingTodoName
        ]);

        $this->cancelEditing();
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5)
        ]);
    }
}
