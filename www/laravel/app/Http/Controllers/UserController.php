<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends CRUDController
{
    protected $classModel = User::class;

    public function hook_validate_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'first_name' => 'required|string|min:1|max:255',
            'last_name' => 'required|string|min:1|max:255',
            'patronymic' => 'required|string|min:1|max:255',
            'email' => "required|email|min:1|max:255|unique:users",
        ]);
    }

    public function hook_validate_update(int $id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'first_name' => 'required|string|min:1|max:255',
            'last_name' => 'required|string|min:1|max:255',
            'patronymic' => 'required|string|min:1|max:255',
            'email' => "required|email|min:1|max:255|unique:users,id,$id",
        ]);
    }
}
