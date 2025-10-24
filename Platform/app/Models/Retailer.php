<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Retailer extends Model
{
    use SoftDeletes;

    protected $table = 'retailer';

    protected $fillable = [
        'business_name',
        'email',
        'phone',
        'finance_email',
        'description',
        'country',
        'vat_number',
        'website_url',
        'city',
        'postal_code',
        'address',
        'currency',
        'account_status',
        'role_id',
    ];

    public $timestamps = true;
}

