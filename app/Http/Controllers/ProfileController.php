<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Users\Update;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function update(Update $request)
    {
        $user = Auth::user();

        if ($request->isMethod('post')) {
            $data = $request->validated();

            if (Hash::check($data['currentPassword'], $user->password)) {
                unset($data['currentPassword']);
                if ((isset($data['password']) || isset($data['password-confirm']))
                    && ($data['password'] !== $data['password-confirm'])) {

                    return \back()->with('error', __('Do not match password in two lines.'));
                } else {
                    unset($data['password-confirm']);
                }

                $data = array_filter($data, static function ($var) {
                    return $var !== null;
                });

                $user = $user->fill($data);

                if ($user->save()) {
                    return \redirect()->route('account.account')->with('success', __('Profile has been updated'));
                }
                return \back()->with('error', __('Profile has  not been updated'));
            } else {
                return \back()->with('error', __('Current password is incorrect'));
            }
        }

        return \view('account.profile.update', [
            'user' => $user
        ]);






    }
}
