<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Company extends Model
{
    use HasFactory;

    public const PATH_PREFIX = 'public';

    public function getNameAttribute()
    {
        if ($this->logo_name) {
            return "{$this->logo_name}";
        }

        return null;
    }

    public function getPathAttribute()
    {
        $name = $this->getNameAttribute();
        if ($name) {
            return self::PATH_PREFIX . "/${name}";
        }

        return null;
    }

    public function getBackgroundUrlAttribute()
    {
        $file = asset('assets/app/korail/img/placeholder.webp');
        if ($this->logo_name) {
            $file = url(Storage::url($this->getPathAttribute()));
            if (! \App::environment(['local', 'testing'])) {
                $file = url(Storage::temporaryUrl($this->getPathAttribute(), now()->addMinutes(5)));
            }
        }
        return $file;
    }
}
