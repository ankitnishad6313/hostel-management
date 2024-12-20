<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function getOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('phone', $request->phone)->where('role', 'student')->where('status', 'active')->first();
        $otpValue = rand(1111, 9999);
        $result = sendOtp($request->phone, $otpValue);
        if($result){
            if (!$user) {
                $otpModel = new Otp;
                $otpModel->phone = $request->phone;
                $otpModel->otp = $otpValue;
                $otpModel->expires_at = now()->addMinutes(5);
                $otpModel->save();
    
                $responseCode = 200;
                $response = [
                    'message' => 'OTP sent successfully',
                    'status' => 1,
                    'phone' => $request->phone
                ];
            } else {
                $user->otp = $otpValue;
                $user->expires_at = now()->addMinutes(5);
                $user->save();
    
                $responseCode = 200;
                $response = [
                    'message' => 'You are already registered. Enter OTP to login.',
                    'status' => 2,
                    'phone' => $request->phone
                ];
            }
        }else{
            $responseCode = 401;
                $response = [
                    'message' => 'Invalid Mobile number!!',
                    'status' => 3,
                ];
        }
        return response()->json($response, $responseCode);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "otp" => "required|digits:4",
            "phone" => "required|digits:10"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('phone', $request->phone)->where('otp', $request->otp)->where('status', 'active')->first();
        if (!$user) {
            $otp = Otp::where('phone', $request->phone)->where('otp', $request->otp)->orderBy('id', 'desc')->first();
            if ($otp) {
                if ($otp->expires_at >= now()) {
                    $responseCode = 200;
                    $response = [
                        'message' => 'OTP Matched',
                        'status' => 1,
                        'phone' => $request->phone
                    ];
                } else {
                    $responseCode = 400;
                    $response = [
                        'message' => 'OTP Expired',
                        'status' => 0,
                        'error' => $validator->errors(),
                    ];
                }
            } else {
                $responseCode = 400;
                $response = [
                    'message' => 'Invalid OTP',
                    'status' => 0,
                    'error' => $validator->errors(),
                ];
            }
        } else {
            if ($user->role == "student") {
                if ($user->expires_at >= now()) {
                    // Login Code and Provide Token to the Student
                    $token = $user->createToken('student-token')->plainTextToken;
                    $user['token'] = $token;
                    $responseCode = 200;
                    $response = [
                        'message' => 'Redirected to Dashboard...',
                        'status' => 2,
                        'student' => [$user],
                    ];
                } else {
                    $responseCode = 422;
                    $response = [
                        'message' => 'OTP Expired',
                        'status' => 0,
                        'error' => $validator->errors(),
                    ];
                }
            } else {
                $responseCode = 401;
                $response = [
                    'message' => 'You are not Allowed to Login.',
                    'status' => 0,
                ];
            }

        }
        return response()->json($response, $responseCode);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'phone' => 'required|digits:10|unique:users,phone',
            'email' => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role = 'student';
        $user->password = Hash::make(123456);
        if ($user->save()) {
            $token = $user->createToken('student-token')->plainTextToken;
            $user['token'] = $token;
            $responseCode = 200;
            $response = [
                'message' => 'Registration Successfull!!',
                'status' => 1,
                'student' => [$user]
            ];
        } else {
            $responseCode = 422;
            $response = [
                'message' => 'Something went Wrong!!',
                'status' => 0,
                'error' => $validator->errors(),
            ];
        }
        return response()->json($response, $responseCode);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        $responseCode = 200;
        $response = [
            'message' => 'Logged out Successfully!!',
            'status' => 1,
        ];
        return response()->json($response, $responseCode);
    }

}
