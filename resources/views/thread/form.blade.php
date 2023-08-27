<div>
    <div class="mb-4">
        <x-input-label for="category_id" value="Categoría" class="text-white/60 mb-2 cursor-pointer" />

        <select
            id="category_id"
            name="category_id"
            class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs capitalize"
        >
            <option value="">Seleccionar categoría</option>

            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"

                    @if (old('category_id', $thread->category_id) == $category->id)
                        selected
                    @endif

                >{{ $category->name }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
    </div>
    <div class="mb-4">
        <x-input-label for="title" value="Título" class="text-white/60 mb-2 cursor-pointer" />
        <x-text-input
            id="title"
            name="title"
            type="text"
            class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs"
            value="{{ old('title', $thread->title) }}"
        />
        <x-input-error :messages="$errors->get('title')" class="mt-1" />
    </div>
    <div class="mb-4">
        <x-input-label for="body_thread" value="Pregunta" class="text-white/60 mb-2 cursor-pointer" />
        <textarea
            id="body_thread"
            name="body"
            rows="10"
            placeholder="Descripción del problema"
            class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs"
        >{{ old('body', $thread->body) }}</textarea>
        <x-input-error :messages="$errors->get('body')" class="mt-1" />
    </div>
</div>
