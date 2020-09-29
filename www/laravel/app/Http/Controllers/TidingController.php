<?php

namespace App\Http\Controllers;

use App\Models\Tiding;
use App\Models\User;
use Illuminate\Http\Request;

class TidingController extends CRUDController
{
    protected $classModel = Tiding::class;

    public function hook_validate_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'text' => 'required|string|min:1|max:2000',
        ]);
    }

    public function hook_validate_update(int $id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'text' => 'required|string|min:1|max:2000',
        ]);
    }
}
