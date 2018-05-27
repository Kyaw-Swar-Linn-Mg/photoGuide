<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'co_id','publisher_id','book_uniq_id','book_name','cover_photo','prize'
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class,'publisher_id','idx');
    }

    public function contentOwner()
    {
        return $this->belongsTo(ContentOwner::class,'co_id','idx');
    }

}
