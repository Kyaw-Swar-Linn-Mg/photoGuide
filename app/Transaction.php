<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function books()
    {
        return $this->belongsTo(Book::class,'book_id','book_uniq_idx');
    }
}
