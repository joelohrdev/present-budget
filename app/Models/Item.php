<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\FloatAsIntegerCast;
use Carbon\CarbonInterface;
use Database\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $child_id
 * @property string $name
 * @property int $cost
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 */
final class Item extends Model
{
    /** @use HasFactory<ItemFactory> */
    use HasFactory;

    protected $fillable = ['child_id', 'name', 'cost'];

    /**
     * @return array<string, string>
     */
    public function casts(): array
    {
        return [
            'id' => 'integer',
            'child_id' => 'integer',
            'name' => 'string',
            'cost' => FloatAsIntegerCast::class,
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}
