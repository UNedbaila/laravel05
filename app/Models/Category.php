<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable =['name']; //Должны указать поля разрешённые к изменению пользователем в бд
    //protected $guarded = ['id']; //Указываем какие поля запрещено изменять в бд
    //protected $table = 'catalog_categories'; //Переименовываем название таблицы
    //protected $primaryKey = 'category_id'; //Смена поля primary id

    public function products(){
        return $this->hasMany(Product::class);
        //$this->belongsToMany(Product::class, 'role_users', 'category_id', 'product_id');
    }

}
