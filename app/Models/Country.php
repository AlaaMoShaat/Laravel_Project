<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }
    }
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($country) {
            $country->cities()->delete();
        });
    }
}
