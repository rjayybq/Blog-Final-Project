<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = ['title', 'content', 'author', 'publish_at', 'photos', 'user_id'];

    protected $casts = [
        'photos' => 'array',
        'publish_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPhotoUrlAttribute()
    {
        return asset('storage/' . $this->photo);
    }
}
