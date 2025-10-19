<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Cars, Owners};


class Mechanics extends Model
{
    use HasFactory;
    protected $table = "mechanics";

    public function carOwner()
    {
        return $this->hasOneThrough(
            Owners::class, // Models muốn liên kết tới
            Cars::class, // Models trung gian
            'mechanic_id', // Khóa ngoại của table trung gian
            'car_id', // Khóa ngoại của table muốn liên kết tới
            'id', // Khóa chính của table hiện tại
            'id' // Khóa chính của table trung gian
        );
    }
}
