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
}
