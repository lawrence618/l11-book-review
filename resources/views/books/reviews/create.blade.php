<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('create review') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- {{ __("You're logged in!") }} -->
                    <h1 class="mb-10 text-2xl">Add Review for {{ $book->title }}</h1>

                    <form method="POST" action="{{ route('books.reviews.store', $book) }}">
                        @csrf
                        <label for="review">Review</label>
                        <textarea name="review" id="review" required class="input mb-4"></textarea>

                        <label for="rating">Rating</label>

                        <select name="rating" id="rating" class="input mb-4" required>
                            <option value="">Select a Rating</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                        <button type="submit" class="btn">Add Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
