<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'statuses';
    protected $guarded = [];
    const STATUS_INACTIVE = 0;

    const STATUS_ACTIVE = 1;
}
