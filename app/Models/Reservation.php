<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'user_id', 'reserved_at', 'returned_at'];

    protected $casts = [
        'reserved_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasExpired()
    {
        return $this->reserved_at && $this->reserved_at->addDays(7)->isPast();
    }

    public function returnBook()
    {
        if ($this->returned_at) {
            return false;  // Již vráceno
        }

        $this->update(['returned_at' => Carbon::now()]);
        $this->book->increment('stock');
        return true;
    }

    public static function reserveBook($bookId, $userId)
    {
        $book = Book::find($bookId);

        if (!$book || $book->stock <= 0) {
            return false;
        }

        if (self::where('book_id', $bookId)->where('user_id', $userId)->whereNull('returned_at')->exists()) {
            return false;
        }

        $book->decrement('stock');
        return self::create([
            'user_id' => $userId,
            'book_id' => $bookId,
            'reserved_at' => Carbon::now(),
        ]);
    }
}
