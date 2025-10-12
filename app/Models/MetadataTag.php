<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetadataTag extends Model
{
    use HasFactory;

    protected $table = 'metadata_tags';
    protected $primaryKey = 'metadata_id';
    public $timestamps = false; // your table doesn’t use created_at/updated_at

    protected $fillable = [
        'document_id',
        'tag',
        'value',
    ];

    // Relationship back to Document
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'document_id');
    }
}
