<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function find(Request $request)
    {
        $searchObj = BaseSearchObject::fromRequest($request);

        return Product::paginate(
            $searchObj->getPageSize(),
            ['*'], 
            'page', 
            $searchObj->getPageNumber()
        );
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_year' => 'required',
            'sex' => 'required',
            'phone_number' => 'required',
            'email' => 'required'
        ]);

        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return User::destroy($id);
    }

    /**
     * Search by name
     */
    public function search($name)
    {
        return User::where('name','like', '%'.$name.'%')->get();
    }
}
