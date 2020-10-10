<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterConfirmationController extends Controller
{
    public function index()
    {
        $user = User::where('confirmation_token', request('token'))
            ->firstOrFail()
            ->confirm();

        return redirect('/threads')
            ->with('flash', 'Your account is confirmed! Now you may participate.');
    }
}
