<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator(
            $request->all(),
            [
                'email' => 'required|unique:admins,email',
                'password' => 'required|unique:admins,email|min:6',
            ],
            [
                'email.required' => 'هذا الحقل مطلوب',
                'password.min' => 'password must at least 6 char'
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $admins = new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));
            $isSaved = $admins->save();
            if ($isSaved) {
                return response()->json([
                    'status' => true,
                    'message' => 'Created is successfully',

                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Created is not successfully',

                ], 400);
            }
        }
    }


    public function login(Request $request)
    {
        $validator = Validator(
            $request->all(),
            [
                'email' => 'required|exists:admins,email',
                'password' => 'required|unique:admins,email|min:6',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $admins = Admin::where('email', $request->get('email'))->first();
            if (Hash::check($request->get('password'), $admins->password)) {
                $token = $admins->createToken('admin_api');
                $admins->setAttribute('token', $token->accessToken);
                return $token;
                return response()->json([
                    'status' => true,
                    'message' => 'Login is successfully',

                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Login is Failed',

                ], 400);
            }
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user('admin_api')->token();
        $revoked = $token->revoke();
        return response()->json([
            'status' => true,
            'message' => 'Logout is successfully',

        ], 200);
    }

    public function forgetPassword(Request $request)
    {
        $validator = Validator(
            $request->all(),
            [
                'email' => 'required|exists:admins,email',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $admins = Admin::where('email', $request->get('email'))->first();
            $authCode = random_int(1000, 9999);
            $admins->authCode = hash::make($authCode);
            $isSaved = $admins->save();

            return response()->json([
                'status' => $isSaved ? true : false,
                'message' => $isSaved ? 'Generated Code is successfully' : 'Generated Code is failed',
                'Code' => $authCode
            ], $isSaved ? 200 : 400);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator(
            $request->all(),
            [
                'email' => 'required|exists:admins,email',
                'authCode' => 'required|digits:4',
                'password' => 'required|string|min:6|confirmed',

            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $admins = Admin::where('email', $request->get('email'))->first();
            if (Hash::check($request->get('authCode'), $admins->authCode)) {
                $admins->password = Hash::make($request->get('password'));
                $admins->authCode = null;

                $isSaved = $admins->save();
                return response()->json([
                    'status' => $isSaved ? true : false,
                    'message' => $isSaved ? 'Restet Password  is successfully' : 'Restet Password is failed',
                ], $isSaved ? 200 : 400);
            } else {
                return response()->json([
                    'status' =>  false,
                    'message' => 'Error',
                ], 400);
            }
        }
    }
}
