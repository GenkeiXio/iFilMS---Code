<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $table = 'storage';
    protected $primaryKey = 'storage_id';
    public $timestamps = false;

    protected $fillable = [
        'document_id',
        'staff_id',
        'storage_date',
    ];

    // Relationship back to Document
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'document_id');
    }
}
