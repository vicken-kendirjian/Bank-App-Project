<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;


    protected $fillable = [
        'transfer_id',
        'sender',
        'receiver',
        'senderNumber',
        'receiverNumber',
        'amount',
        'date',
        'type' //1:deposit 2:withdrawal 3:transfer
    ];

    public function fromAccount()  
    {
        return $this->belongsTo(Account::class, 'sender', 'account_id');
        //$transfer->fromAccount->user->first_name
    }

    public function toAccount()
    {   
        return $this->belongsTo(Account::class, 'receiver', 'account_id');
    }
}


