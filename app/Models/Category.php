<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable =[
        "name",
        "logo",
        "description",
        "parent_id",
        "created_by",
        "data"
    ];
    protected $casts =[
        'data'=>'array'
    ];
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
