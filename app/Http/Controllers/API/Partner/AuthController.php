<?php

namespace App\Http\Controllers\API\Partner;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Notifications\AdminNotification;
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
            'nama_bank' => ['required', 'string', 'max:100'],
            'nomor_rekening' => ['required', 'string', 'max:20'],
            'nama_toko' => 'required',
            'alamat_toko' => 'required',
            'device_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $new_user = new Pengelola_Percetakan();
        $new_user->nama_lengkap = $request->get('nama_lengkap');
        $new_user->email = $request->get('email');
        $new_user->password = Hash::make($request->get('password'));
        $new_user->nomor_hp = $request->nomor_hp;
        $new_user->nama_bank = $request->nama_bank;
        $new_user->nomor_rekening = $request->nomor_rekening;
        $new_user->nama_toko = $request->nama_toko;
        $new_user->alamat_toko = $request->alamat_toko;
        $new_user->deskripsi_toko = $request->deskripsi_toko;
        $new_user->save();
        $new_user->push();

        $data = [
            'token' => $new_user->createToken($request->device_name)->plainTextToken,
            'user' => $new_user,
        ];

        Admin::find(1)->notify(new AdminNotification('pendaftaranPartner', $new_user->id_pengelola));
        return responseSuccess('Hay ' . $request->get('nama_lengkap') . ' Anda telah terdaftar', $data, 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:pengelola_percetakan,email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        if (!Pengelola_Percetakan::where('email', $request->email)->exists()) {
            return responseError("Email anda tidak di temukan", null, 422);
        }

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = Pengelola_Percetakan::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            return responseError('Opps..  password anda salah', null, 422);
        }

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
