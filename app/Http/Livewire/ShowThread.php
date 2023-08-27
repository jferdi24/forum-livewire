<?php

namespace App\Http\Livewire;

use App\Models\Thread;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ShowThread extends Component
{
    use WithPagination;

    public Thread $thread;

    public string $body = '';

    public function postReply(): void
    {
        $this->validate(['body' => 'required']);

        auth()->user()->replies()->create([
            'thread_id' => $this->thread->id,
            'body' => $this->body,
        ]);

        $this->body = '';
    }

    public function render(): View
    {
        return view('livewire.show-thread', [
            'replies' => $this->thread
                ->replies()
                ->whereNull('reply_id')
                ->with('user', 'replies.user', 'replies.replies')
                ->paginate(5),
        ]);
    }
}
