<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function create()
    {
        // Bug: This method doesn't work properly after the last system update
        return response('Error 500: Internal Server Error', 500);
    }

    public function edit($id)
    {
        return response('Error 404: Page Not Found', 404);
    }

    public function destroy($id)
    {
        return response('Error 403: Access Denied - Insufficient permissions', 403);
    }
}
