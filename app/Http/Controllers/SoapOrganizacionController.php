<?php

namespace App\Http\Controllers;

use App\Models\Organizacion;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SoapOrganizacionController extends Controller
{
    //

    public function server()
    {
        $server = new \SoapServer(null, [
            'uri' => url('/soap/organizaciones'),
        ]);

        $server->setObject($this);
        $server->handle();
    }


    /** 
     * Método SOAP que devuelve todas las organizaciones
     */

    public function getOrganizaciones()
{
    $organizaciones = Organizacion::select('id','nombre','telefono','email','descripcion','latitud','longitud')->get();

    $result = [];
    foreach ($organizaciones as $org) {
        $result[] = (object)[
            'id' => $org->id,
            'nombre' => $org->nombre,
            'telefono' => $org->telefono,
            'email' => $org->email,
            'descripcion' => $org->descripcion,
            'latitud' => $org->latitud,
            'longitud' => $org->longitud,
        ];
    }

    return $result;
}

    /**
     * REST wrapper respuesta SOAP en JSON
     * Ruta la ruta es GET /soap/organizaciones/rest
     */
    public function restWrapper(Request $request)
    {
        // utilizamos la logica del metodo SOAP
        $soapResult = $this->getOrganizaciones();

        // cambiamos a formato JSON
        $data = array_map(function ($org) {
            return [
                'id' => $org->id,
                'nombre' => $org->nombre,
                'telefono' => $org->telefono,
                'email' => $org->email,
                'descripcion' => $org->descripcion,
                'latitud' => $org->latitud,
                'longitud' => $org->longitud,
            ];
        }, $soapResult);

        return response()->json(['data' => $data], 200);
    }
}
