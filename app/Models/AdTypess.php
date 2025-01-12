<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdTypess extends Model
{
    use HasFactory;
    protected $table = 'ads_fields';

    public function ads()
    {
        return $this->hasMany(Ads::class, 'ad_type_id');
    }

    public function adType()
    {
        return $this->belongsTo(AdTypess::class, 'ad_type_id');
    }
}