<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;

class RegisterController extends Controller
{
    /**
     * @var RegisterService $registerService
     */
    private $registerService;

    /**
     * RegisterController constructor.
     * @param RegisterService $registerService
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function index()
    {
        return view('register');
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        if (is_null($this->registerService->registerUser($request->all(), $request->ip()))) {

            return redirect()->route('home');
        } else {
            $request->session()->flash('error', 'register process was in this IP around last 3 days');

            return redirect()->back();
        }
    }
}
