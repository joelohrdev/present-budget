<?php

declare(strict_types=1);

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

final class FloatAsIntegerCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value / 100;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return (int) round($value * 100);
    }
}
