<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listings extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'logo', 'company', 'location', 'website', 'email', 'description', 'tags', 'user_id'];

    public function scopeFilter($query, array $filters){
        // dd($filters['tag']);

        if($filters['tag'] ?? false){
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false){
            $query->where('title', 'like', '%' . request('search') . '%')->orWhere('tags', 'like', '%' . request('search') . '%')->orWhere('company', 'like', '%' . request('search') . '%');
        }
    }

    public function user(){

        return $this->belongsTo(User::class, 'user_id');
        // this means that the listings model belongs to a user

    }
}
