<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use App\Models\User\UserDetails;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(new UserCollection(User::with(User::RELATION_USER_DETAILS)->get()));
    }

    public function store(CreateRequest $request): JsonResponse
    {
        /** @var array<string, string> $data */
        $data = $request->validated();
        /** @var User $user */
        $user = User::query()->create($data);
        if ($request->address) {
            $user->userDetails()->create([UserDetails::COLUMN_ADDRESS => $request->address]);
        }

        return response()
            ->json(
                [
                    'data' => new UserResource($user->load(USER::RELATION_USER_DETAILS)),
                    'message' => 'User created successfully',
                ]
            );
    }

    public function update(UpdateRequest $request, User $user): JsonResponse
    {
        /** @var array<string, string> $data */
        $data = $request->validated();
        $user->update($data);
        $user->userDetails()->updateOrCreate([], [UserDetails::COLUMN_ADDRESS => $request->address]);

        return response()
            ->json(
                [
                    'data' => new UserResource($user->load(USER::RELATION_USER_DETAILS)),
                    'message' => 'User updated successfully',
                ]
            );
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
