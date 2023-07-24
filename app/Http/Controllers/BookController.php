<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $books = Book::query()->withCount(['orders' => function ($query) {
            return $query->whereMonth('date', now()->month);
        }])->take(10)->orderByDesc('orders_count')->get();

        return BookResource::collection($books);
    }
}
