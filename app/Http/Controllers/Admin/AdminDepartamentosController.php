<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Emails\EmailsController;
use App\Http\Controllers\GlobalController;
use App\Mail\Credenciales;
use App\Mail\Departamento;
use App\Models\Coordinadores;
use App\Models\Credenciales1;
use App\Models\Departamentos;
use App\Models\Maestros;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use League\Flysystem\CorruptedPathDetected;

class AdminDepartamentosController extends Controller
{

    public function nuevoDepartamento(Request $request, $interfaz)
    {
        $cuenta = $request->input('numeroCuenta');
        $departamento = $request->input('departamento');
        $edificio = $request->input('edificio');
        $aula = $request->input('aula');

        $GlobalController = new GlobalController();

        if($GlobalController->tamanioCuenta($cuenta) == true)
        {
            return back()->with('status', 'El numero de cuenta no cumple con el formato adecuado')->with('error',false)->withInput();
        }
        //nombre_departamento y aula 
        $departamentoExistente = Departamentos::where('nombre_departamento', $departamento)->first();
        $aulaExistente = Departamentos::where('edificio', $edificio)->where('aula', $aula)->first();
        //buscar numerod e cuenta relaccionado con el usuarios
        $cuentaExistente = Coordinadores::where('no_cuenta', $cuenta)->first();
        $buscarMaestro = Maestros::where('no_cuenta', $cuenta)->first();

        if($cuentaExistente && $interfaz == 'nuevo')
        {
            return back()->with('status', 'El número de cuenta ya se encuentra asignado a un departamento.')
            ->with('error',false)->withInput();
        }

        if(!$buscarMaestro && $interfaz == 'nuevo')
        {
            return back()->with('status', 'El número de cuenta no está asociado a un maestro o no existe.')
            ->with('error',false)->withInput();
        }

        if($departamentoExistente)
        {
            return back()->with('status', 'El departamento ya existe')
            ->with('error',false)->withInput();
        }

        if($aulaExistente)
        {
            return back()->with('status', 'El aula ya se encuentra asignada a otro departamento. ')
            ->with('error',false)->withInput();
        }

        if ($buscarMaestro && $interfaz == "nuevo") 
        {
            $idUsuario = $buscarMaestro->id;

            //echo $cuenta . $departamento . $edificio . $aula . $idUsuario;

            Credenciales1::where('id_usuario', $idUsuario)->update(['rol' => 'cordinador']);
            
            $idDepartamento =  Departamentos::create([
                'id_usuario' => $idUsuario,
                'nombre_departamento' => $departamento,
                'edificio' => $edificio ,
                'aula' => $aula,
            ]);

            $datosDepartamento = Coordinadores::where('id_departamento', $idDepartamento->id)->first();
            $notificarCoordinador = new EmailsController();
            $notificarCoordinador -> notificarDepartamento($datosDepartamento->correo, ($datosDepartamento->nombre . " " . $datosDepartamento->apellido_paterno), $datosDepartamento->nombre_departamento );

            return redirect('/admin-consulta-coordinador')->with('status', 'Departamento creado con exito. se ha notificado al nuevo Coordinador')->with('error',true);

        } else if($interfaz == "editar") //$buscarMaestro &&
        {
              
        }else
        {
            return back()->with('status', 'No se pudo crear el departamento, contacta con soporte tecnico. ')
            ->with('error',false)->withInput();
        }
        
        //return back()->with('status', 'esto no deveria pasar, contacta con soporte tecnico. ')
        //->with('error',false)->withInput();
        /*
        $nuevoDepartamento = Departamentos::create([
            'no_cuenta' => $request->input('numeroCuenta'),
            'nombre' => $request->input('nombres'),
            'apellido_paterno' => $request->input('apellidoPaterno'),
            'apellido_materno'=> $request->input('apellidoMaterno'),
            'telefono' => $request->input('telefono'),
            'estatus' => true,
        ]);
        */
        //echo $cuenta . $departamento . $edificio . $aula;
    }

    public function editarDepartamento(Request $request, $idDepartamento, $idUsuario)
    {
        
        $cuenta = $request->input('numeroCuenta');
        $departamento = $request->input('departamento');
        $edificio = $request->input('edificio');
        $aula = $request->input('aula');

        $GlobalController = new GlobalController();

        if($GlobalController->tamanioCuenta($cuenta) == true)
        {
            return back()->with('status', 'El numero de cuenta no cumple con el formato adecuado')->with('error',false)->withInput();
        }

        //buscar numerod e cuenta relaccionado con el usuarios
        
        $cuentaExistente = Coordinadores::where('no_cuenta', $cuenta)->where('id_departamento', '!=', $idDepartamento)->first(); //vista departamentos
        $salonExistente = Coordinadores::where('edificio',$edificio )->where('aula', $aula)->where('id_departamento', '!=', $idDepartamento)->first();
        $departamentoExistente = Coordinadores::where('nombre_departamento', $departamento)->where('id_departamento', '!=', $idDepartamento)->first();
        $buscarCuenta = Coordinadores::where('no_cuenta', $cuenta)->first();
        $buscarMaestro = Maestros::where('no_cuenta', $cuenta)->first();


        
        if($cuentaExistente)
        {
            return back()->with('status', 'El número de cuenta ya se encuentra asignado a un departamento.')
            ->with('error',false)->withInput();
        }

        if($salonExistente)
        {
            return back()->with('status', 'El aula ya se encuentra asignada a otro departamento. ')
            ->with('error',false)->withInput();
        }

        if($departamentoExistente)
        {
            return back()->with('status', 'El departamento ya existe')
            ->with('error',false)->withInput();
        }

        if($buscarCuenta) //no se modifica al cordinador
        {
            Departamentos::where('id', $idDepartamento)->update([
                'nombre_departamento' => $departamento,
                'edificio' => $edificio, 
                'aula' => $aula,
            ]);

            return redirect('/admin-consulta-coordinador')->with('status', 'Departamento actualizado con exito ')->with('error',true);

        }else// se modifica al cordinador. 
        {
            if(!$buscarMaestro)
            {
                return back()->with('status', 'El número de cuenta no está asociado a un maestro o no existe.')
                ->with('error',false)->withInput();
            }
            else
            {
                //id
                Credenciales1::where('id_usuario', $idUsuario)->update(['rol' => 'maestro']);
                Credenciales1::where('id_usuario', $buscarMaestro->id)->update(['rol' => 'cordinador']);

                Departamentos::where('id', $idDepartamento)->update([
                    'id_usuario' => $buscarMaestro->id,
                    'nombre_departamento' => $departamento,
                    'edificio' => $edificio ,
                    'aula' => $aula,
                ]);


                //editando
                $datosDepartamento = Coordinadores::where('id_departamento', $idDepartamento->id)->first();
                $notificarCoordinador = new EmailsController();
                $notificarCoordinador -> notificarDepartamento($datosDepartamento->correo, ($datosDepartamento->nombre . " " . $datosDepartamento->apellido_paterno), $datosDepartamento->nombre_departamento );

                return redirect('/admin-consulta-coordinador')->with('status', 'Departamento actualizado con exito, se ha notificado al nuevo Coordinador')->
                with('error',true);

            }
        }

        return back()->with('status', 'No se pudo actualizar el departamento, contacta con soporte tecnico. ')
        ->with('error',false)->withInput();
        
    }



    //eliminar departamento
    public function eliminarDepartamento(Request $request, $idUsuario)
    {
        //$departamento = Usuarios::where('no_cuenta', $cuenta)->first();

        $departamento = Departamentos::where('id_usuario', $idUsuario);

        // Verificar si el maestro existe
        if (!$departamento) 
        {
            return redirect()->back()->with('status', 'El departamento no fue encontrado.')->with('error',false);
        }
        else
        {
            $departamento->delete();

            Credenciales1::where('id_usuario', $idUsuario)->update(['rol' => 'maestro']);

            return redirect()->back()->with('status', 'Departamento eliminado con exito. El coordinador ha sido degradado a maestro.')
            ->with('error',true);
        }
    }

    public function datosDepartamento(Request $request, $idDepartamento)
    {
        $id = $request->session()->get('id');

        $admin = Usuarios::find($id);
        $departamento = Coordinadores::where('id_departamento', $idDepartamento)->first();
        return view('administradores.departamentos.editarDepartamento', compact('admin', 'departamento'));
    }
    //id | id_usuario |   nombre_departamento    | edificio | aula




}