<?php

namespace OutMart\Laravel\RewardPoints\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Reward Points Model of OutMart
 * 
 * @property integer $id
 * @property string $type
 * @property integer $points
 * @property string|null $comment
 * @property \Carbon\Carbon $expired_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expired_at' => 'datetime'
    ];
}
