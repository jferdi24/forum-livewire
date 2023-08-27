<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Thread;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ShowThreads extends Component
{
    use WithPagination;

    public string $search = '';

    public string $category = '';

    public function filterByCategory(string $category): void
    {
        $this->category = $category;
    }

    public function render(): View
    {
        $threads = Thread::query()
            ->where('title', 'like', "%$this->search%");

        if ($this->category) {
            $threads = $threads->where('category_id', $this->category);
        }

        $threads = $threads
            ->with('user', 'category')
            ->withCount('replies')
            ->latest()
            ->paginate(5);

        return view('livewire.show-threads', [
            'categories' => Category::query()->get(),
            'threads' => $threads,
        ]);
    }
}
