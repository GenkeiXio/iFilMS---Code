<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retrieval extends Model
{
    protected $table = 'retrieval';
    protected $primaryKey = 'retrieval_id';
    public $timestamps = false;

    protected $fillable = [
        'document_id',
        'staff_id',
        'retrieval_date',
    ];
}