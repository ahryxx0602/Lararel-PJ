<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    //Quy ước tên Table
    /*
    Tên Model: Post => Tên bảng: posts
    Tên Model: ProductCategory => Tên bảng: product_categories
    */
    protected $table = 'posts';

    //Quy ước khóa chính
    /*
    Mặc định Laravel lấy trường id làm khóa chính
    */
    protected $primaryKey = 'id';

    // public $incrementing = true;
    // protected $keyType = 'string';

    public $timestamps = true;

    // Cấu hình giá trị mặc định
    protected $attributes = [
        'status' => 0,
    ];

    protected $fillable = [
        'title',
        'content',
        'status'
    ];
}
