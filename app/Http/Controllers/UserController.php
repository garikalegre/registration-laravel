<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckUsernameRequest;
use App\Source\User\UserRepository;
use App\User;

class UserController extends Controller
{
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param CheckUsernameRequest $request
     * @return string
     * @throws \App\Repositories\Criterias\Exceptions\CriteriaBuildException
     */
    public function checkUsername(CheckUsernameRequest $request)
    {
        $users = $this->userRepository->findByCriteria([User::COLUMN_USERNAME => $request->name]);

        return $users ? 'username exist' : 'username free';
    }
}
