<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\EmergencyEvent;
use App\Models\SiteUrl;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display addUser url content.
     *
     * @param  \App\Models\EmergencyEvent  $emergencyEvent
     * @return \Illuminate\Contracts\View\View
     */
    public function addUser(): View
    {
        return view('admin.addUser');
    }


    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Object
     */
    public function addUserTable(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/addUser')
                ->withInput()
                ->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 2;
        $user->save();

        session()->flash('flash_message', '新規管理者を登録しました');
        return redirect('admin');
    }

    /**
     * Display updateUser date content.
     *
     * @param  \App\Models\EmergencyEvent  $emergencyEvent
     * @return \Illuminate\Contracts\View\View
     */
    public function updateUser(): View
    {
        $user = Auth::user();
        return view('admin.updateUser', [
            'user' => $user,
        ]);
    }

    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Object
     */
    public function updateUserTable(Request $request)
    {
        //バリデーション
            $validator = Validator::make($request->all(), [
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255',\Illuminate\Validation\Rule::unique('users')->ignore(Auth::user()->id)],
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/updateUser')
                ->withInput()
                ->withErrors($validator);
        }

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            session()->flash('flash_message', 'パスワードがマッチしません');
            return redirect('/updateUser');
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        session()->flash('flash_message', 'ユーザーデータを変更しました。');
        return redirect('updateUser');
    }


}
