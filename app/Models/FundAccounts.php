<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundAccounts extends Model
{
    protected $fillable = ['date', 'receipt_id', 'debit', 'credit', 'description'];
}
