<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/contenido/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:50',
            'apPaterno' => 'required|string|max:50',
            'apMaterno' => 'required|string|max:50',
            'area' => 'required', 
            'fechaAlta' => 'required|date', //Fecha de Alta en la página 
            'telefono' => 'required|numeric|digits:10',
            'status' => 'required|string|max:50', //Tipo Logico: Activado/Desactivado. Por defecto irá activado
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:6|confirmed',
            'responsable' => 'required|string', //Quien metió al usuario
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password']),
        // ]);
        return view('auth.register');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $mensaje=[
            'required'=>'El campo :attribute es requerido',
            'CURP.regex' => 'El formato del CURP no es válido.',
            'CURP.unique' => 'Este CURP ya se encuentra registrado.',
            'CURP.size' => 'Complete el campo correctamente',
            'Organo.required_if' => 'Si desea ser donador, debe seleccionar al menos un órgano.',
            'min' => 'Complete el campo correctamente',
            'max' => 'Ha excedido la cantidad de caracteres establecidos',
            'Telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
            'Telefono.unique' => 'Este teléfono ya ha sido registrado'
        ];
        
        $this->validate($request,$mensaje,[
            'Nombre' => 'Nombre',
            'ApPaterno' => 'Apellido paterno',
            'ApMaterno' => 'Apellido materno',
            'FechaNac' => 'Fecha de nacimiento',
            'Ocupacion' => 'Ocupacion',
            'EstCiv' => 'Estado civil',
            'Estudios' => 'Estudios',
            'EstadoProc' => 'Entidad de procedencia',
            'Religion' => 'Religión',
            'CURP' => 'CURP',
            'Sexo' => 'Sexo',
            'estadoNac' => 'Estado de Nacimiento', 
            'Alcaldia' => 'Municipio o Alcaldía',
            'Colonia' => 'Localidad',
            'Donador' => 'solicitado', //XD
            'Organo' => 'Órgano',
            'Referencias' => 'Referencias',
            'Telefono' => 'Telefono',
            'Pregunta' => 'solicitado',
            'Respuesta' => 'solicitado',
        ]);
        $this->validate($request,$mensaje,[
            'Nombre' => 'required',
            'Organo' => 'required|array'
        ]);
        
        $datosUsuario = $request->except(['_token']);
            unset($datosUsuario['Organo']);

        foreach ($datosUsuario as $key => $value) {
            if(is_string($value)){
                $value = str_replace(
                    ['Á','É','Í','Ó','Ú','á','é','í','ó','ú'],
                    ['A','E','I','O','U','A','E','I','O','U'],
                    $value
                );
                $datosUsuario[$key] = strtoupper($value);
            }
        }

        DB::beginTransaction();
    }
}
