<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomAuthController  extends Controller
{
   public function index()
   {
       return view('auth.login');
   }

   public function customLogin(Request $request)
   {
       $request->validate([
           'email' => 'required',
           'password' => 'required',
       ]);

       $credentials = $request->only('email', 'password');
       if (Auth::attempt($credentials)) {
           return redirect()->intended('counter')
                       ->withSuccess('Signed in');
       }

       return redirect("login")->withSuccess('Login details are not valid');
   }

   public function registration()
   {
       return view('auth.registration');
   }

   public function customRegistration(Request $request)
   {
       $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:users',
           'password' => [
                       'required',
                       'string',
                       'min:10',             // must be at least 10 characters in length
                       'regex:/[a-z]/',      // must contain at least one lowercase letter
                       'regex:/[A-Z]/',      // must contain at least one uppercase letter
                       'regex:/[0-9]/',      // must contain at least one digit
                       'regex:/[@$!%*#?&_-]/', // must contain a special character
           ],
       ]);

       $data = $request->all();
       $check = $this->create($data);

       return redirect("counter")->withSuccess('You have signed-in');
   }

   public function create(array $data)
   {
     return User::create([
       'name' => $data['name'],
       'email' => $data['email'],
       'password' => Hash::make($data['password'])
     ]);
   }

   public function dashboard()
   {
       if(Auth::check()){
           return view('dashboard');
       }

       return redirect("login")->withSuccess('You are not allowed to access');
   }

   public function counter()
   {
       if(Auth::check()){
           $distritos = DB::table('distritos')->count();
           $municipios = DB::table('municipios')->count();
           $info_mun = DB::table('informacoes_municipios')->count();
           $cidades = DB::table('cidades')->count();
           $cod_pos = DB::table('codigos_postais')->count();
           $inst = DB::table('instituicoes')->count();
           $tipos_ensino = DB::table('tipos_ensino')->count();
           $cursos_inst = DB::table('instituicoes_has_curso')->count();
           $provas = DB::table('provas_ingresso')->count();
           $exames = DB::table('exames')->count();
           $cursos = DB::table('cursos')->count();
           $areas = DB::table('area_estudo')->count();
           $users = DB::table('users')->count();
           $total = $distritos+$municipios+$info_mun+$cidades+$cod_pos+$inst+$tipos_ensino+$cursos_inst
                    +$provas+$exames+$cursos+$areas+$users;
           return view('counter',compact(
                'distritos',
                'municipios',
                'info_mun',
                'cidades',
                'cod_pos',
                'inst',
                'tipos_ensino',
                'cursos_inst',
                'provas',
                'exames',
                'cursos',
                'areas',
                'users',
                'total'
           ));
       }

       return redirect("login")->withSuccess('You are not allowed to access');
   }

   public function signOut() {
       Session::flush();
       Auth::logout();

       return Redirect('login');
   }
}
