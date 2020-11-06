<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Contacto;

class ContactoController extends Controller
{
    public function index()
    {
		$email = Contacto::where('info', 'email')->first();
		$phone = Contacto::where('info', 'phone')->first();
		$direccion = Contacto::where('info', 'direccion')->first();
		$facebook = Contacto::where('info', 'facebook')->first();
		$instagram = Contacto::where('info', 'instagram')->first();
    	return view('cms.contacto.index', compact(
			'email',
			'phone',
			'direccion',
			'facebook',
			'instagram',
    	));
    }


    public function actualizarInformacion(Request $request)
    {
    	$email = Contacto::where('info', 'email')->first();
    	$phone = Contacto::where('info', 'phone')->first();
    	$direccion = Contacto::where('info', 'direccion')->first();
    	$facebook = Contacto::where('info', 'facebook')->first();
    	$instagram = Contacto::where('info', 'instagram')->first();

    	$email->update([
    		'valor' => $request->email,
    	]);

    	$phone->update([
    		'valor' => $request->phone,
    	]);

    	$direccion->update([
    		'valor' => $request->direccion,
    	]);

    	$facebook->update([
    		'valor' => $request->facebook,
    	]);


    	$instagram->update([
    		'valor' => $request->instagram,
    	]);


    	return back()->with('message', 'Información actualizada con éxito');
    	
    }
}
