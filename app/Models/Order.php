<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'date'
    ];

    const CREATED_AT = null;
    const UPDATED_AT = null;

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
