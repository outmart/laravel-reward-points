<p align="center"><a href="#" target="_blank"><img src="./cover.jpg"/></a></p>

# Laravel Reward Points

Grant and manage reward points for your customers.

## Install

```bash
composer require outmart/laravel-reward-points
```

## Add trait

```php
<?php

namespace App\Models;

use OutMart\Laravel\RewardPoints\HasRewardable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasRewardable;
}
```

## Add points

```php
$customer->addPoints(
    points: 500,
    comment: 'Comment',
    expired_at: Carbon::now()->addDay()
);
```

## Withdraw points

```php
$customer->withdrawPoints(
    points: 500,
    comment: 'Comment'
);
```

## Get points

```php
$customer->getPoints();
```
