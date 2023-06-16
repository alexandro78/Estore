<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavMenu extends Model
{
    use HasFactory;

    public function getSubItem()
    {
        return $this->hasMany(NavMenu::class, 'parent_id');
    }
}
