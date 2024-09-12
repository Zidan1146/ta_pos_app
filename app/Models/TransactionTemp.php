<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionTemp extends Model
{
    use HasFactory;
    protected $fillable = [
        'itemName',
        'count',
        'cost',
        'item_id'
    ];

    protected $table = "transactionTemps";
    protected $keyType = 'string';

    public function item() {
        return $this->belongsTo(Item::class);
    }
}
