<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'user_id',
        'priority_id',
        'category_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
     public function category(){
        return $this->belongsTo(Category::class);
    }
     public function priority(){
        return $this->belongsTo(Priority::class);
    }
}
