<?php

namespace App\Http\Controllers\API\Member;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:member'],
            'password' => ['required', 'string', 'min:8'],
            'nomor_hp' => ['required', 'string', 'max:13', 'unique:member'],
            'device_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
            // return responseError("Data yang anda masukkan tidak valid");
        }

        $new_user = new Member;
        $new_user->nama_lengkap = $request->get('nama_lengkap');
        $new_user->email = $request->get('email');
        $new_user->password = Hash::make($request->get('password'));
        $new_user->nomor_hp = $request->nomor_hp;
        $new_user->save();

        $data = [
            'token' => $new_user->createToken($request->device_name)->plainTextToken,
            'user' => $new_user,
        ];
        return responseSuccess('Hay ' . $request->get('nama_lengkap') . ' Anda telah terdaftar', $data, 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:member,email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        if (!Member::where('email', $request->email)->exists()) {
            return responseError("Email anda tidak di temukan", null, 422);
        }

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = Member::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Opps.. password anda salah'], 422);
        }

        //$abilities = $user->role == 'admin' ? ['user:index', 'user:create'] : ['user:index'];

        $data = [
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'user' => $user,
        ];

        return responseSuccess("Login Berhasil", $data);
    }

    public function logout()
    {
        $user = request()->user();

        if (request()->token_id) {

            $user->tokens()->where('id', request()->token_id)->delete();
            return response()->json(['message' => 'Sukses logged out']);
        }

        $user->tokens()->delete();
        return response()->json(['message' => 'Sukses logged out']);

    }
}
