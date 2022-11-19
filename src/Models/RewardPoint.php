<?php

namespace OutMart\Laravel\RewardPoints\Models;

use Illuminate\Database\Eloquent\Model;

class RewardPoint extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'outmart_reward_points';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'points',
        'comment',
        'expired_at',
    ];
}
