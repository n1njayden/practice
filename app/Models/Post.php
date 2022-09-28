<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scope($query, array $filters){
        $query->when($filters['search'] ?? false, fn ($query, $search)=>
            $query
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('title', 'like', '%' . request('search') . '%'));



        // $query->when($filters['search'] ?? false, fn ($query, $search)=>
        //     $query
        //         ->whereHas('category', fn($query)=>
        //              $query->where('slug' $category)
        //         )
        //     );
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo((Category::class));
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
