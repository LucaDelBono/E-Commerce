<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'quantity'
    ];

    public function getImageUrl()
    {
        if($this->image){
            return url('storage/' . $this->image);
        }
    }
    
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like' , "%{$value}%");
    }
}
