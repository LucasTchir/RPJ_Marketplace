<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ["image", "main_image", "item_name", "price", "user_id", "category_id", "condition", "quantity", "description", "name", "category_name", "lat", "lng"];

    public function scopeFilter($query, array $filters) {
        if ($filters["search"] ?? false) {
            $searchTerm = $filters["search"];
            $query->where(function ($query) use ($searchTerm) {
                $query->whereRaw('item_name COLLATE utf8mb4_general_ci REGEXP ?', [$searchTerm]) 
                    ->orWhereRaw('description COLLATE utf8mb4_general_ci REGEXP ?', [$searchTerm])
                    ->orWhereHas("user", function ($query) use ($searchTerm) {
                        $query->whereRaw('name COLLATE utf8mb4_general_ci REGEXP ?', [$searchTerm]);
                    })
                    ->orWhereHas("category", function ($query) use ($searchTerm) {
                        $query->whereRaw('category_name COLLATE utf8mb4_general_ci REGEXP ?', [$searchTerm]); 
                    });
            });
        }

        if ($filters["min"] ?? false) {
            $query->where("price", ">=", $filters["min"]);
        }
    
        if ($filters["max"] ?? false) {
            $query->where("price", "<=", $filters["max"]);
        }

        if ($filters["order"] ?? false) {
            if ($filters["order"] === 'low_to_high') {
                $query->orderBy('price', 'asc');
            } elseif ($filters["order"] === 'high_to_low') {
                $query->orderBy('price', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }
    }

    public function loadMore() {
        $this->amount += 6;
    }
    
    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }   

    public function category() {
        return $this->belongsTo(Category::class);
   }
}
