<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ManajemenMenu extends Model
{
    // ManajemenMenu menjadi table manajemen_menus. table jamak dan snake_case
    //jika ingin menggunakan table lain pada model ini protected $table = 'menus'; 
    protected $fillable = ['title', 'url', 'icon', 'parent_id', 'order', 'isActive'];
    public function children()
    {
        return $this->hasMany(ManajemenMenu::class, 'parent_id')->orderBy('order');
    }
}
