<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Document extends Model
{
    use HasFactory, SoftDeletes; 

    protected $table = 'documents';
    protected $primaryKey = 'document_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'staff_id',
        'file_path',
        'file_type',
        'uploaded_by',
        'category',
        'meeting_type',
        'upload_date',
        'deleted_at',
        'deleted_by'
    ];

    protected $dates = ['deleted_at']; //optional, but helps with Carbon date formatting

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

    public function deletedByStaff()
    {
        return $this->belongsTo(Staff::class, 'deleted_by', 'staff_id');
    }
}
