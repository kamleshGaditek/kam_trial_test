<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['user_id', 'service_id', 'amount'];

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
