<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'name', 'role', 'image_path', 'status'
    ];

    public function getCreatedAtBrAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()->orderBy("created_at", 'DESC') : static::where(function ($q) use ($query) {
            $q
                ->where('name', 'LIKE', '%'. $query . '%')
                ->orWhere('role', 'LIKE', '%' . $query . '%');
        })->orderBy('created_at', 'DESC');
    }
}
