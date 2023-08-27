<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThread;
use App\Http\Requests\UpdateThread;
use App\Models\Category;
use App\Models\Thread;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ThreadController extends Controller
{
    public function create(): View
    {
        return view('thread.create', [
            'categories' => Category::query()->select('id', 'name')->get(),
            'thread' => new Thread(),
        ]);
    }

    public function store(StoreThread $request): RedirectResponse
    {
        auth()->user()->threads()->create($request->all());

        return response()->redirectToRoute('dashboard');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Thread $thread): View
    {
        $this->authorize('update', $thread);

        return view('thread.edit', [
            'categories' => Category::query()->select('id', 'name')->get(),
            'thread' => $thread,
        ]);
    }

    public function update(UpdateThread $request, Thread $thread): RedirectResponse
    {
        $thread->update($request->all());

        return response()->redirectToRoute('thread', $thread);
    }
}
