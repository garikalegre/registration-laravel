<?php

namespace App\Services;

use App\Interfaces\RegisterServiceInterface;
use App\Source\User\UserRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class RegisterService implements RegisterServiceInterface
{
    /**
     * @var Carbon $carbon
     */
    private $carbon;

    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * RegisterService constructor.
     * @param Carbon $carbon
     * @param UserRepository $userRepository
     */
    public function __construct(Carbon $carbon, UserRepository $userRepository)
    {
        $this->carbon = $carbon;
        $this->userRepository = $userRepository;

    }

    /**
     * @param array $data
     * @param string $ip
     * @return User|null
     */
    public function registerUser(array $data, string $ip): ?User
    {
        if ($this->validateIP($ip)) {

            /** @var User $user */
            $user = $this->userRepository->create($this->composeData($data, $ip));

            return $user;
        } else {
            return null;
        }

    }

    /**
     * @param string $ip
     * @return bool
     */
    private function validateIP(string $ip): bool
    {
        return (boolean)User::where(User::COLUMN_REGISTRATION_IP, $ip)
            ->where(User::COLUMN_CREATED, '>', Carbon::now()->subDays(3))
            ->count();
    }

    /**
     * @param array $data
     * @param $ip
     * @return array
     */
    private function composeData(array $data, $ip)
    {
        return [
            User::COLUMN_USERNAME => $data['name'],
            User::COLUMN_EMAIL => $data['email'],
            User::COLUMN_PASSWORD => Hash::make($data['password']),
            User::COLUMN_REGISTRATION_IP => $ip
        ];
    }
}
