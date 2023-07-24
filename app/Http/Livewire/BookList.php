<?php

namespace App\Http\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\Order;
use Carbon\CarbonPeriod;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;

class BookList extends Component
{
    public $search = '';

    public $months = [];

    public $month;

    public function mount()
    {
        $period = CarbonPeriod::create(now()->startOfYear(), '1 month', now());

        foreach ($period as $key => $date) {
            $this->months[$date->format('Y-m')] = $date->monthName;
        }

        $this->month = now()->format('Y-m');
    }

    public function buyBook($book)
    {
        Order::query()->create([
            'book_id' => $book['id'],
            'date' => now()
        ]);
    }

    public function render()
    {
        return view('livewire.book-list', [
            'books' => Book::query()->when(strlen($this->search) >= 2, function ($query) {
                return $query
                    ->where('title', 'LIKE', '%'.$this->search.'%')
                    ->orWhereHas('authors', function ($query) {
                        return $query->where('name', 'LIKE', '%'.$this->search.'%');
                    })
                    ->with('orders', 'authors')
                    ->withCount(['orders as months_orders' => function ($query) {
                        return $query->whereMonth('date', Str::after($this->month, '-'));
                    }])
                    ->orderByDesc('months_orders');
            }, function ($query) {
                return $query->whereHas('orders', function ($query) {
                    return $query->whereMonth('date', Str::after($this->month, '-'));
                })->with('orders', 'authors')
                    ->withCount(['orders as months_orders' => function ($query) {
                        return $query->whereMonth('date', Str::after($this->month, '-'));
                    }])
                    ->orderByDesc('months_orders');
            })->get()->take(9)
        ]);
    }
}
