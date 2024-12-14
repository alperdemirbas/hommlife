<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaign';
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
    ];
    protected $casts = [
        'start_date' => 'datetime:Y-m-d H:i:s',
        'end_date' => 'datetime:Y-m-d H:i:s',
    ];

    public function periods(): HasMany
    {
        return $this->hasMany(CampaignPeriod::class, 'campaign_id', 'id');

    }

}
