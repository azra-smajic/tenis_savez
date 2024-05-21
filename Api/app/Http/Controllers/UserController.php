<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Helpers\BaseSearchObject;
use Illuminate\Http\Request;
use App\Http\Services\UserService;

class UserController extends BaseController
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        parent::__construct(User::class);
        $this->middleware('auth:api');
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function find(Request $request)
    {
        return $this->userService->findUserByParameters(BaseSearchObject::fromRequest($request));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_year' => 'required',
            'sex' => 'required',
            'phone_number' => 'required',
            'email' => 'required|string|unique:users,email',
            'tennis_association_id' => ['nullable', function ($attribute, $value, $fail) {
                if (!empty($value) && !preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $value)) {
                    $fail('The ' . $attribute . ' field must be empty or a valid UUID.');
                }
            }],
        ]);
        return $this->userService->createUser($fields,$request->input("role_id",null));
    }

}
