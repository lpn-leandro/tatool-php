<?php

namespace App\Models;

use Core\Database\ActiveRecord\Model;
use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\BelongsToMany;
use Lib\Validations;
use DateTime;

/**
 * @property int $id
 * @property DateTime $date
 * @property string $size
 * @property string $location
 * @property string $status
 * @property int $users_id
 * @property int $tattooists_id
 * @property User $tattooist
 * @property User $user
 *
 */
class Appointment extends Model
{
    protected static string $table = 'appointments';
    protected static array $columns = ['date', 'size', 'location', 'status', 'users_id', 'tattooists_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function tattooist(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tattooists_id');
    }

    public function validates(): void
    {
        Validations::notEmpty('date', $this);
        Validations::notEmpty('size', $this);
        Validations::notEmpty('location', $this);
        Validations::notEmpty('status', $this);
        Validations::notEmpty('users_id', $this);
        Validations::notEmpty('tattooists_id', $this);
    }
}
