<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\BelongsToMany;
use Lib\Validations;
use Core\Database\ActiveRecord\Model;
use DateTime;

/**
 * @property int $id
 * @property DateTime $date
 * @property string $size
 * @property string $location
 * @property string $status
 * @property int $users_id
 * @property int $tattooists_id
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

    public function validates(): void
    {
        Validations::notEmpty('date', $this);
    }


}