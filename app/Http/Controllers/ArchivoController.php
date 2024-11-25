<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Ui\Presets\React;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

    public function upload(Request $request)
    {
        $id = $request->id;
        $file = $request->file('file');
        $fileName = time() . '-' . $file->getClientOriginalName();
       // $request->file('file')->storeAs($id, $fileName, 'public'); //cargar public 
        $request->file('file')->storeAs($id,$fileName);//privada

        $archivo = new Archivo();
        $archivo->carpeta_id = $request->id;
        $archivo->nombre = $fileName;
        $archivo->estado_archivo = 'PRIVADO';
        $archivo->save();
        return redirect()->back()
            ->with('mensaje', 'Se registro el archivo de la manera correcta')
            ->with('icono', 'success');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Archivo $archivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Archivo $archivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Archivo $archivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Archivo $archivo)
    {
        //
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $archivo = Archivo::find($id);
        $estado_archivo=$archivo->estado_archivo;
        if($estado_archivo=="PRIVADO"){
            Storage::delete($archivo->carpeta_id . '/' . $archivo->nombre);
        }else{
            Storage::delete('public/' . $archivo->carpeta_id . '/' . $archivo->nombre);
        }
       
        Archivo::destroy($id);
        return redirect()->back()
        ->with('mensaje', 'Se elimino el archivo de la manera correcta')
        ->with('icono', 'success');
    }

    public function cambiar_privado_a_publico(Request $request){
        $id=$request->id;
        $estado_archivo="PUBLICO";
        $archivo=Archivo::find($id);
        $carpeta_id=$archivo->carpeta_id;
        $nombre=$archivo->nombre;

        $archivo->estado_archivo=$estado_archivo;
        $archivo->save();

        $ruta_archivo_privado=$carpeta_id.'/'.$nombre;
        $ruta_archivo_publico='public/'.$carpeta_id.'/'.$nombre;

        Storage::move($ruta_archivo_privado,$ruta_archivo_publico);

        return redirect()->back()
        ->with('mensaje', 'Se cambio estado del archivo de la manera correcta')
        ->with('icono', 'success');
    }

    public function cambiar_publico_a_privado(Request $request){
        $id=$request->id;
        $estado_archivo="PRIVADO";

        $archivo=Archivo::find($id);
        $carpeta_id=$archivo->carpeta_id;
        $nombre=$archivo->nombre;

        $archivo->estado_archivo=$estado_archivo;
        $archivo->save();

        $ruta_archivo_privado=$carpeta_id.'/'.$nombre;
        $ruta_archivo_publico='public/'.$carpeta_id.'/'.$nombre;

        Storage::move($ruta_archivo_publico,$ruta_archivo_privado);

        return redirect()->back()
        ->with('mensaje', 'Se cambio estado del archivo de la manera correcta')
        ->with('icono', 'success');
    }
}
