<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $fillable = [
        'itemName',
        'count',
        'cost',
        'pay',
        'date'
    ];

    public function transactionTemp() {
        return $this->hasMany(TransactionTemp::class, 'id', 'transactionTemp_id');
    }
}
