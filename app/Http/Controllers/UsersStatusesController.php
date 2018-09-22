<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use App\User;
use Illuminate\Http\Request;

class UsersStatusesController extends Controller
{
    public function index(User $user)
    {
        return StatusResource::collection($user->statuses()->latest()->paginate());
    }
}
