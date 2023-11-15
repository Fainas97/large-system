<?php

namespace App\Http\Requests\User;

use App\Models\User\User;

class UpdateRequest extends CreateRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        /** @var User $user */
        $user = $this->route('user');

        return [
            ...parent::rules(),
            'email' => 'required|email|unique:users,email,' . $user->id . '|max:255',
        ];
    }
}
