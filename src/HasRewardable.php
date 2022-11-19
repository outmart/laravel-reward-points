<?php

namespace OutMart\Laravel\RewardPoints;

use Carbon\Carbon;
use OutMart\Laravel\RewardPoints\Models\RewardPoint;

trait HasRewardable
{
    /**
     * Add points to a specific customer
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
     * Withdraw points to a specific customer
     *
     * @param int $points
     * @param string $comment
     * @return int \OutMart\Laravel\RewardPoints\HasRewardable
     */
    public function withdrawPoints(int $points, string $comment = null)
    {
        if ($this->getPoints() < $points) {
            dd('Con\'t');
        }

        $this->points()->create([
            'type' => 'withdraw',
            'points' => $points,
            'comment' => $comment,
        ]);

        return $this->getPoints();
    }

    /**
     * Get the total balance of points
     *
     * @return int
     */
    public function getPoints()
    {
        $added_points = $this->points()->where('type', 'add')
            ->whereNull('expired_at')
            ->orWhereDate('expired_at', '>', Carbon::now())
            ->sum('points');

        $withdraw_points = $this->points()->where('type', 'withdraw')->sum('points');

        return $added_points - $withdraw_points;
    }

    /**
     * Get all of the customer's points.
     */
    public function points()
    {
        return $this->morphMany(RewardPoint::class, 'modelble');
    }
}
