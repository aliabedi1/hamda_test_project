<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'body',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo( User::class, 'user_id');
    }

    
    public function expire()
    {
        return $this->hasOne( DocumentExpireTimeStamp::class, 'document_id');
    }
}
