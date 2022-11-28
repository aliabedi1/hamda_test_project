<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentExpireTimeStamp extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'document_expire_time';
    protected $fillable = ['expire_timestamp' , 'document_id' ];


    
    public function document()
    {
        return $this->belongsTo( Document::class, 'document_id');
    }





}

