<?php

namespace OutMart\Laravel\RewardPoints;

use OutMart\Laravel\RewardPoints\Models\RewardPoint;

class PointsManager
{
    public function get()
    {
        $points = RewardPoint::with(['rewardable'])->get();

        return $points;
    }
}
