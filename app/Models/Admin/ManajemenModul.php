<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ManajemenModul extends Model
{
    protected $fillable = ['title', 'url', 'icon', 'parent_id', 'order', 'role', 'isActive'];
    public function children()
    {
        return $this->hasMany(ManajemenModul::class, 'parent_id')->orderBy('order');
    }
    public function parent()
    {
        return $this->belongsTo(ManajemenModul::class, 'parent_id');
    }

}
