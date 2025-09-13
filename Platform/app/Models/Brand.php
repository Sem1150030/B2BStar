<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'finance_email', 'role_id', 'motto', 'description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the user that owns the brand as a role.
     */
    public function user()
    {
        return $this->morphOne(User::class, 'role');
    }
}
