<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $fillable = ['path', 'disk', 'access_token'];

    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', Carbon::now());
    }
}
