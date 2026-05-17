<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    use HasFactory;
    protected $table = 'client_profile';

    protected $fillable = [
        'user_id',
        'client_name',
        'client_email',
        'client_phone_no',
        'client_address',
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class, 'client_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function business(){
        return $this->belongsTo(BusinessModel::class);
    }

    public function clients(){
        return $this->belongsTo(ClientModel::class);
    }
}
