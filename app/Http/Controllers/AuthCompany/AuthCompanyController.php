<?php

namespace App\Http\Controllers\AuthCompany;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Company;

class AuthCompanyController extends Controller
{
    use RegistersUsers;
    // use AuthenticatesUsers;

    public function __construct(){
        $this->middleware('guest:company', ['verified'])->except('logoutCompany');
    }

    public function showLoginForm(){
      return view('authCompany.login');
    }
    public function showRegisterForm(){
      return view('authCompany.register');
    }

  	public function register(Request $request){
      $this->validate($request, [
        'name' => 'required|min:3',
        'email' => 'required|email|max:255|unique:companies',
        'password' => 'required|min:6|confirmed',
        'address' => 'required',
        'harga' => 'required',
        'phone' => 'required|max:13|min:10|unique:companies',
      ]);

      Company::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password),
          'address' => $request->address,
          'harga' => $request->harga,
          'phone' => $request->phone
      ]);
      return redirect()->route('login')->with('message','Berhasil Registrasi, Silahkan Login');
    }


    public function login(Request $request){
      // $this->validate($request, [
      //   'email' => 'required|email|max:255|unique:companies',
      //   'password' => 'required|min:6|max:8|confirmed',
      // ]);
      $credential = [
        'email' => $request->email,
        'password' => $request->password
      ];

      $company = Company::where('email', $request->email)->first();
        // if(!$company->email_verified_at){
        //     return back()->with('error', 'Login Gagal, Verifikasi Email Dahulu');
        // }

      if (!Auth::guard('company')->attempt($credential, $request->member)) {
          return back()->withInput($request->only('email','remember'));
      }
      return redirect()->route('dashboard')->with('message','Berhasil Login');
    }

    public function logoutCompany(Request $request){
      Auth::guard('company')->logout();
      return redirect('/');
    }
}
