<form
    action="{{ isset($article) ? route('admin.blog.articles.update', $article->id) : route('admin.blog.articles.store') }}"
    method="POST"
    class="grid grid-cols-1 sm:grid-cols-2 gap-5"
    data-prevent-unsaved-changes
    enctype="multipart/form-data"
>
    @csrf
    @if (isset($article))
        @method('PUT')
    @endif

    <x-inputs.input
        name="title"
        label="{{ __('Title') }}"
        placeholder="{{ __('Enter Title') }}"
        :value="isset($article) ? $article->title : ''"
        :required="true"
    />

    <x-inputs.input
        name="author"
        label="{{ __('Author') }}"
        placeholder="{{ __('Enter Author') }}"
        :value="isset($article) ? $article->author : ''"
        :required="true"
    />

    <div class="sm:col-span-2">
        <label for="content" class="form-label">{{ __('Content') }}</label>
        <textarea name="content" id="content" rows="3"
                  placeholder="{{ __('Enter Content...') }}"
                  class="form-control-textarea">{{ old('content', isset($article) ? $article->content : '') }}</textarea>
        @error('content')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <label class="flex items-center gap-3 cursor-pointer">
        <input type="checkbox" name="is_published" value="1" class="form-checkbox"
               @if(old('is_published', isset($article) ? $article->is_published : null)) checked @endif>
        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Is Published') }}</span>
    </label>

    <div class="flex items-center gap-3 pt-2 sm:col-span-2">
        <x-buttons.submit-buttons cancelUrl="{{ route('admin.blog.articles.index') }}" />
    </div>
</form>
