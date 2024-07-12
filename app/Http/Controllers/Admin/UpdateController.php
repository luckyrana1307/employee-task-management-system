<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin; // Ensure this import

class UpdateController extends Controller
{
    public function index(){
        return view('admin.auth.update');
    }

    public function update(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all()
            ]);
        } else {
            $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $result = $admin->save();

            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => ['Admin Profile updated successfully']
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => ['Admin Profile not updated successfully']
                ]);
            }
        }
    }
}
