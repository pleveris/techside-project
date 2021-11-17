<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','title', 'description', 'level', 'promo', 'picture','approved',
    ];
    protected $perPage = 10;

    public function scopeNotApproved($query)
    {
        return $this->where('approved', false);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    public function getIsNewAttribute()
    {
        return $this->created_at > now()->subWeek();
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function computers()
    {
        return $this->belongsToMany(Computer::class);
    }

}
