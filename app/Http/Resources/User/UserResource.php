<?php

namespace App\Http\Resources\User;

use App\Models\User\User;
use App\Models\User\UserDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var UserDetails|null $userDetails */
        $userDetails = $this->whenLoaded(User::RELATION_USER_DETAILS);

        return [
            User::COLUMN_ID => $this->{User::COLUMN_ID},
            User::COLUMN_FIRST_NAME => $this->{User::COLUMN_FIRST_NAME},
            User::COLUMN_LAST_NAME => $this->{User::COLUMN_LAST_NAME},
            User::COLUMN_EMAIL => $this->{User::COLUMN_EMAIL},
            User::COLUMN_PASSWORD => $this->{User::COLUMN_PASSWORD},
            UserDetails::COLUMN_ADDRESS => $userDetails?->address,
            User::COLUMN_CREATED_AT => $this->{User::COLUMN_CREATED_AT},
            User::COLUMN_UPDATED_AT => $this->{User::COLUMN_UPDATED_AT},
        ];
    }
}
