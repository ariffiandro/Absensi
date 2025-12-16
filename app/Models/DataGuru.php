<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class DataGuru extends Model
{
    protected $table = 'data_guru';

    protected $fillable = [
        'nama',
        'kelas',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
