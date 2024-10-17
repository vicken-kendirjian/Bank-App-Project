<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'account_id',
        'account_number',
        'account_name',
        'date opened',
        'client_id',
        'currency',
        'amount',
        'active',
        'blocked'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->account_number = $model->generateRandomString(20);
        });
    }

        /**
     * Generate a random string.
     *
     * @param int $length
     * @return string
     */
    public function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'client_id', 'user_id');
    }

}
