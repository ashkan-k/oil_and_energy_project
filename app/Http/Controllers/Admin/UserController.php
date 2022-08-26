<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Responses;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $objects = User::Filter(\request('search'),\request('filter'))->orderByDesc(env('ORDER_BY_FIELD'))->paginate(env('PAGINATION_NUMBER'));
        return view('Admin.Users.list' , compact('objects'));
    }

    public function create()
    {
        return view('Admin.Users.form');
    }

    public function store(UserRequest $request)
    {
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());
        $user->update(['phone_verified_at' => Carbon::now()]);
        return $this->SuccessRedirect("کاربر مورد نظر با موفقیت افزوده شد." , 'users.index');
    }

    public function edit(User $user)
    {
        return view('Admin.Users.form' , compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request['password'] = $request->password ? Hash::make($request->password) : $user->password;
        $user->update($request->all());
        return $this->SuccessRedirect("کاربر مورد نظر با موفقیت ویرایش شد." , 'users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->SuccessRedirect("کاربر مورد نظر با موفقیت حذف شد." , 'users.index');
    }
}
