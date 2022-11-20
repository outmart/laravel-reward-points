<?php

namespace OutMart\Laravel\RewardPoints;

use Carbon\Carbon;
use OutMart\Laravel\RewardPoints\Models\RewardPoint;

trait HasRewardable
{
    /**
     * Add points to a specific model
     *
     * @param int $points
     * @param string $comment
     * @return int \OutMart\Laravel\RewardPoints\HasRewardable
     */
    public function addPoints(int $points, string $comment = null, $expired_at = null)
    {
        $this->points()->create([
            'type' => 'add',
            'points' => $points,
            'comment' => $comment,
            'expired_at' => $expired_at,
        ]);

        return $this->getPoints();
    }

    /**
     * Withdraw points from a specific model
     *
     * @param int $points
     * @param string $comment
     * @return int \OutMart\Laravel\RewardPoints\HasRewardable
     */
    public function withdrawPoints(int $points, string $comment = null)
    {
        $available_points = $this->getPoints();

        if ($available_points < $points) {
            throw new \Exception('OutMart: You cannot deduct more points than that already exists.');
        }

        $this->points()->create([
            'type' => 'withdraw',
            'points' => $points,
            'comment' => $comment,
        ]);

        return $available_points - $points;
    }

    /**
     * Get the total balance of points
     *
     * @return int
     */
    public function getPoints()
    {
        $added_points = $this->points()->where('type', 'add')->where(function ($query) {
            $query->whereNull('expired_at')->orWhereDate('expired_at', '>', Carbon::now());
        })->sum('points');

        $withdraw_points = $this->points()->where('type', 'withdraw')->sum('points');

        return $added_points - $withdraw_points;
    }

    /**
     * Get all records of the model's points.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function points()
    {
        return $this->morphMany(RewardPoint::class, 'rewardable');
    }
}
