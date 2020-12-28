<?php

namespace App\Http\Controllers\API\Partner;

use App\Http\Controllers\Controller;
use App\Pengelola_Percetakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pengelola_percetakan'],
            'password' => ['required', 'string', 'min:8'],
            'nomor_hp' => ['required', 'string', 'max:13', 'unique:pengelola_percetakan'],
            'nama_toko' => 'required',
            'alamat_toko' => 'required',
            'deskripsi_toko' => 'required',
            'device_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
            // return responseError("Data yang anda masukkan tidak valid");
        }

        $new_user = new Pengelola_Percetakan();
        $new_user->nama_lengkap = $request->get('nama_lengkap');
        $new_user->email = $request->get('email');
        $new_user->password = Hash::make($request->get('password'));
        $new_user->nomor_hp = $request->nomor_hp;
        $new_user->nama_toko = $request->nama_toko;
        $new_user->alamat_toko = $request->alamat_toko;
        $new_user->deskripsi_toko = $request->deskripsi_toko;
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
            'email' => 'required|email|exists:pengelola_percetakan,email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
            // return responseError("Email anda tidak di temukan");
        }

        if ($user = Pengelola_Percetakan::where('email', $request->email)->first()) {
            return responseError("Email anda tidak di temukan", null, 422);
        }
        if (!Hash::check($request->password, $user->password)) {
            return responseSuccess('Opps..  password anda salah', null, 422);
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
    public function index()
    {
        return responseSuccess("data user yang login", request()->user());
    }
}
