<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignPeriod extends Model
{
    protected $table = 'campaign_periods';
    protected $fillable = [
        'name',
        'campaign_id',
        'period_id',
        'start_date',
        'end_date',
        'min_price'
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d H:i:s',
        'end_date' => 'datetime:Y-m-d H:i:s',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
}
