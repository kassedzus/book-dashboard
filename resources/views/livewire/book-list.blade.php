<div>
    <div>
        <label for="search" class="block text-sm font-medium leading-6 text-gray-900">Quick search</label>
        <div class="relative mt-2 flex items-center justify-center">
            <input wire:model="search" type="text" name="search" id="search" class="block w-1/2 rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
    </div>
    <div class="flex items-end justify-center mb-4">
        <label for="name" class="block text-sm font-medium leading-6 text-gray-900 mr-2 mb-1.5">Most popular books in </label>
        <div class="relative mt-2">
            <select {{ strlen($search) >= 2 ? 'disabled' : '' }} type="month" name="name" id="name" class="peer block w-28 border-0 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" wire:model="month">
                @foreach($months as $month => $name)
                    <option value="{{ $month }}">{{ $name }}</option>
                @endforeach
            </select>
            <div class="absolute inset-x-0 bottom-0 border-t-2 border-indigo-600" aria-hidden="true"></div>
        </div>
    </div>

    <ul role="list" class="grid grid-cols-1 gap-x-4 gap-y-6 lg:grid-cols-3 xl:gap-x-8">
        @forelse($books as $book)
            <li class="overflow-hidden rounded-xl border border-gray-200">
                <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6 relative">
                    <img src="{{ $book->cover_url }}" alt="Book cover" class="h-32">
                    <div class="text-sm text-left">
                        <div class="text-gray-400">Title:</div>
                        <div>
                            {{ $book->title }}
                        </div>
                    </div>
                    <div class="text-sm text-left">
                        <div class="text-gray-400">Author/-s:</div>
                        <div>
                            @forelse($book->authors as $author)
                                <div class="mb-2">{{ $author->name }}</div>
                            @empty
                                <div class="text-amber-400">No authors</div>
                            @endforelse
                        </div>
                    </div>
                    <button wire:click="buyBook({{ $book }})" type="button" class="absolute bottom-0 right-0 inline-flex items-center gap-x-1.5 rounded-md bg-green-600 px-1.5 py-0.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 7.756a4.5 4.5 0 100 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Buy
                    </button>

                </div>
                <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                    <div class="flex justify-between gap-x-4 py-3">
                        <dt class="text-gray-500">Last ordered</dt>
                        <dd class="text-gray-700"><time>{{ $book->orders->sortByDesc('date')->first()->date->format('d.m.Y.') }}</time></dd>
                    </div>
                    <div class="flex justify-between gap-x-4 py-3">
                        <dt class="text-gray-500">Ordered this month</dt>
                        <dd class="text-gray-700">
                            <div class="font-medium text-gray-900">{{ $book->months_orders }}</div>
                        </dd>
                    </div>
                    <div class="flex justify-between gap-x-4 py-3">
                        <dt class="text-gray-500">Total ordered</dt>
                        <dd class="flex items-start gap-x-2">
                            <div class="font-medium text-gray-900">{{ $book->orders->count() }}</div>
                        </dd>
                    </div>
                </dl>
            </li>
        @empty
            <li class="overflow-hidden col-span-3 relative">
                <div class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-center">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <h3 class="mt-2 ml-4 text-sm font-semibold text-gray-900">No books found</h3>
                </div>
            </li>
        @endforelse
    </ul>
</div>
