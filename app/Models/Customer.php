<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

  
    protected $fillable = [
        'user_id',      
        'name',
        'email',
        'phone',        
        'deal_value',   
        'company',
        'status',
        'priority',     
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}