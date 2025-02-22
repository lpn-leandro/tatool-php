<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsTo;
use Lib\Validations;
use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property int $name
 * @property int $address 
 * @property int $user_id
 * @property int $studio_id
 */
class Studio extends Model
{
    protected static string $table = 'studios';
    protected static array $columns = ['name', 'address'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function validates(): void
    {
        Validations::uniqueness(['name', 'address'], $this);
    }
}