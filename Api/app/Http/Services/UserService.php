<?php

namespace App\Http\Services;

use App\Factories\QueryFactory;
use App\Models\User;
use Illuminate\Support\Str;

class UserService
{
    public function createUser($user, $roleId)
    {
        $randomPassword = Str::random(6);
        EmailService::sendCreateUserMail($user['email'], $user['first_name'] . ' ' . $user['last_name'], $randomPassword);

        if($roleId == null){
            $data = json_decode(Redis::get('roles'), true);


        }

        $createdUser = User::create([
            ...$user,
            'password' => bcrypt($randomPassword),
        ]);



    }

    public function findUserByParameters($searchObj)
    {
        $query = QueryFactory::createFilteredQuery(User::class, $searchObj->getTennisAssociationId());

        if(!empty($searchObj->getSearchPhrase())){
            $query->where(function ($query) use ($searchObj) {
                $query->where('first_name', 'like', '%' . $searchObj->getSearchPhrase() . '%')
                    ->orWhere('last_name', 'like', '%' . $searchObj->getSearchPhrase() . '%')
                    ->orWhere('email', 'like', '%' . $searchObj->getSearchPhrase() . '%');
            });
        }
        return $query->paginate(
            $searchObj->getPageSize(),
            ['*'],
            'page',
            $searchObj->getPageNumber());
    }
}
