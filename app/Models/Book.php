<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'classification', 'shelf', 'country', 'city', 'edition', 'quantity', 'language', 'page_count',
        'year', 'isbn', 'entry_date', 'tomb_date', 'observations', 'author_id', 'publisher_id', 'book_type_id', 'subject_id', 'collection_id'];

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function bookType()
    {
        return $this->belongsTo(BookType::class, 'book_type_id');
    }

    public function setEntryDateAttribute($value)
    {
        $this->attributes['entry_date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setTombDateAttribute($value)
    {
        $this->attributes['tomb_date'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
