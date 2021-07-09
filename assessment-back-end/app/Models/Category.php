<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory, Notifiable;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
       
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
