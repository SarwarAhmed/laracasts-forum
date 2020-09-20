<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => $this->getActivity($user),
        ]);
    }

    protected function getActivity(User $user)
    {
        return $user->activity()->latest()->with('subject')->take(50)->get()->groupBy(function ($activity) {
            return $activity->created_at->format('Y-m-d');
        });
    }
}
