<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'status',
        'user_id'
    ];

    protected static function booted()
    {
        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function scopeFindById($query, $id){
    //     return $query->findOrFail($id); 
    // }
    public function scopeFilterByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
