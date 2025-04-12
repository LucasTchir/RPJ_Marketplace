<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Recommendation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', "username", 'email', 'description', "phone", 'photo', "password", "lat", "lng"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function listings() {
        return $this->hasMany(Listing::class);
    }

    public function isAdmin() {
        return $this->group == "admin";
    }

    public function followers() {
        return $this->hasMany(Follow::class, 'followed_id');
    }

    public function following() {
        return $this->hasMany(Follow::class, 'follower_id');
    }
 
    public function isFollowing($userId) {
        return $this->following()->where('followed_id', $userId)->exists();
    }

    public function recommendations() {
        return $this->hasMany(Recommendation::class, 'user_id');
    }

    public function recommending() {
        return $this->hasMany(Recommendation::class, 'user_id');
    }

    public function isRecommending($userIdRecommended) {
        return $this->recommending()->where('category_id', $userIdRecommended)->exists();
    }

    public function ratings() {
        return $this->hasMany(Rating::class, 'rated_user_id');
    }

    public function averageRating() {
        return $this->ratings()->avg('rating');
    }

    public function recommendationsMtm() {
        return $this->belongsToMany(Category::class, 'recommendations', 'user_id', 'category_id');
    }
    
}
