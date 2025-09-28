<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class RegisterUserAction
{
    /**
     * @throws Throwable
     */
    public function handle(array $payload): User
    {
        try {
            return DB::transaction(function () use ($payload) {
                $user = User::query()
                    ->create($payload);

                event(new Registered($user));

                Auth::login($user);

                return $user;
            });
        } catch (Throwable $e) {
            logger()->error('Error in CreateUserAction::handle()', [
                'message' => $e->getMessage(),
                'payload' => $payload,
            ]);

            throw $e;
        }
    }
}
