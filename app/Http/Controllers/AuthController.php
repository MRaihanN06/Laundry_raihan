<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
  
  
class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('login');
        }
        return view('/login');
    }
  
    public function login(Request $request)
    {
        
    }
  
    public function showFormRegister()
    {
        
    }
  
    public function register(Request $request)
    {
        
    }
  
    public function logout()
    {
       
    }
  
  
}