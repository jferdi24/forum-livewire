<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;
use Livewire\Component;

class ShowReply extends Component
{
    use AuthorizesRequests;

    public Reply $reply;

    public string $body = '';

    public bool $is_creating = false;

    public bool $is_editing = false;

    /** @var string[] */
    protected $listeners = ['refresh' => '$refresh'];

    public function updatedIsCreating(): void
    {
        $this->is_editing = false;
        $this->body = '';
    }

    /**
     * @throws AuthorizationException
     */
    public function updatedIsEditing(): void
    {
        $this->authorize('update', $this->reply);

        $this->is_creating = false;
        $this->body = $this->reply->body;
    }

    /**
     * @throws AuthorizationException
     */
    public function updateReply(): void
    {
        $this->authorize('update', $this->reply);

        $this->validate(['body' => 'required']);
        $this->reply->update(['body' => $this->body]);
        $this->is_editing = false;
    }

    public function postChild(): void
    {
        if (! is_null($this->reply->reply_id)) {
            return;
        }

        $this->validate(['body' => 'required']);

        auth()->user()->replies()->create([
            'reply_id' => $this->reply->id,
            'thread_id' => $this->reply->thread->id,
            'body' => $this->body,
        ]);

        $this->is_creating = false;
        $this->body = '';
        $this->emitSelf('refresh');
    }

    public function render(): View
    {
        return view('livewire.show-reply');
    }
}
