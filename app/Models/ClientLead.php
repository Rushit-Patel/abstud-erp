<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientLead extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'client_id',
        'client_date',
        'lead_type',
        'purpose',
        'country',
        'coaching',
        'branch',
        'assion_owner',
        'tag',
        'status',
        'sub_status',
        'remark',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(ClientDetails::class, 'client_id');
    }
}
