<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientDetails extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'mobile_no',
        'country_code',
        'email_id',
        'country',
        'state',
        'city',
        'whatsapp_no',
        'whatsapp_country_code',
        'source',
        'address',
        'lead_type',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function leads()
    {
        return $this->hasMany(ClientLead::class, 'client_id');
    }
}
