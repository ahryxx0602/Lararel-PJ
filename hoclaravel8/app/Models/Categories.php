<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;

class Categories extends Model
{
    use HasFactory;
    protected $table = "categories";
    public function posts()
    {
        return $this->belongsToMany(
            Posts::class, // liên kết với model Posts
            "categories_posts", // Tên bảng trung gian
            "category_id",
            "post_id"
        );
    }
}
