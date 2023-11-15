<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $address
 */
class UserDetails extends Model
{
    use HasFactory;

    public const COLUMN_ID = 'id';
    public const COLUMN_USER_ID = 'user_id';
    public const COLUMN_ADDRESS = 'address';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        self::COLUMN_USER_ID,
        self::COLUMN_ADDRESS,
    ];

    /**
     * @return BelongsTo<User, UserDetails>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
