<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- {{ __("You're logged in!") }} -->
                    <div class="mb-4">
                        <h1 class="mb-2 text-2xl">{{ $book->title }}</h1>

                        <div class="book-info">
                            <div class="book-author mb-4 text-lg font-semibold">by {{ $book->author }}</div>
                            <div class="book-rating flex items-center">
                                <div class="mr-2 text-sm font-medium text-slate-700">
                                    <x-star-rating :rating="$book->reviews_avg_rating" />
                                </div>
                                <span class="book-review-count text-sm text-gray-500">
                                    {{ $book->reviews_count }}
                                    {{ Str::plural('review', $book->reviews_count) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <a href="{{ route('books.reviews.create', $book) }}" class="reset-link">
                            Add a review!</a>
                    </div>

                    <div>
                        <h2 class="mb-4 text-xl font-semibold">Reviews</h2>
                        <ul>
                            @forelse($book->reviews as $review)
                                <li class="book-item mb-4">
                                    <div>
                                        <div class="mb-2 flex items-center justify-between">
                                            <div class="font-semibold">
                                                <x-star-rating :rating="$review->rating" />
                                            </div>
                                            <div class="book-review-count">
                                                {{ $review->created_at->format('M j, Y') }}
                                            </div>
                                        </div>
                                        <p class="text-gray-700">{{ $review->review }}</p>
                                    </div>
                                </li>
                            @empty
                                <li class="mb-4">
                                    <div class="empty-book-item">
                                        <p class="empty-text text-lg font-semibold">No reviews yet</p>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>