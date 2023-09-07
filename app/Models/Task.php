<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function assignedBy()
    {
        return $this->belongsTo(User::class,'assigned_by','id');
    }
    public function assignedTo()
    {
        return $this->belongsTo(User::class,'assigned_to','id');
    }
}
