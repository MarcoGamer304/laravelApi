<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TerrainBase extends Model
{
    use HasFactory;

    protected $table = 'terrain_matrix';

    protected $fillable = [
        'terrain_base',
        'build_admin'
    ];
}
