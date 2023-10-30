<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function changePassword()
    {
        return response()->view('cms.auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $guard = Auth('admin')->check() ? 'admin' : 'auther';
        $validator = Validator($request->all(), [
            'current_password' => 'required|string|min:6|max:25',
            'new_password' => 'required|string|min:6|max:25|confirmed',
            'confirm_password' => 'required|string|min:6|max:25',
        ]);
        if (!$validator->fails()) {
            $user = Auth('admin')->user();
            $user->password = Hash::make($request->get('new_password'));
            $isSaved = $user->save();
            if ($isSaved) {
                return response()->json([
                    'icon' => 'success',
                    'title' => 'Change Password Successfully'
                ], 200);
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'Change Password Failed'
                ], 400);
            }
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }
}
