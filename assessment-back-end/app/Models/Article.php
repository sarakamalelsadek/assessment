<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Article extends Model
{
    use HasFactory,Notifiable;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'category_id'
       
    ];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
