<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','phone','email','message','answer','answer_at'
    ];

    protected $casts = [
        'answer_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id','id')->select('id','email','sname','name');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('id','email','sname','name');
    }

    public function status()
    {
        return $this->belongsTo(QuestionStatus::class);
    }
}
