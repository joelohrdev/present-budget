<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\FloatAsIntegerCast;
use Carbon\CarbonInterface;
use Database\Factories\ChildFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $name
 * @property int $budget
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 */
final class Child extends Model
{
    /** @use HasFactory<ChildFactory> */
    use HasFactory;

    protected $fillable = ['name', 'budget'];

    public function casts(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'budget' => FloatAsIntegerCast::class,
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function getFirstLetterAttribute(): string
    {
        return $this->name[0];
    }
}
