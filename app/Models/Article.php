<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'description',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function currentLoan()
    {
        return $this->loans()->whereNull('returned_at')->first();
    }
} 