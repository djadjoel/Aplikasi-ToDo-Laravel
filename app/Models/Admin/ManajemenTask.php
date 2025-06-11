<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class ManajemenTask extends Model
{
    use SoftDeletes;
    protected $table = 'tasks';
    protected $fillable = ['user_id', 'judul', 'deskripsi', 'is_done'];
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
