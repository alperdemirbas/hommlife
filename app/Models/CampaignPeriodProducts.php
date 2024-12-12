<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignPeriodProducts extends Model
{
    protected $table = 'campaign_period_products';
    protected $fillable = [
        'period_id',
        'product_id',
    ];

    /**
     * @return BelongsTo
     * @description Bağlı Dönemler
     */
    public function period(): BelongsTo
    {
        return $this->belongsTo(CampaignPeriod::class, 'period_id');
    }

    /**
     * @return BelongsTo
     * @description Bağlı Ürünler
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
