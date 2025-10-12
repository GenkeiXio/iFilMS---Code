<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    protected $primaryKey = 'document_id';
    public $timestamps = false; // important ⚡

    protected $fillable = [
        'title',
        'staff_id',
        'file_path',
        'file_type',
        'uploaded_by',
        'category',
        'meeting_type',
        'upload_date'
    ];

    public function metadataTags()
    {
        return $this->hasMany(MetadataTag::class, 'document_id', 'document_id');
    }

    public function storage()
    {
        return $this->hasOne(Storage::class, 'document_id', 'document_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }
}
