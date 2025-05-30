<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contact.contacto');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => (Auth::user()) ? ['nullable', 'email'] : ['required', 'email'],
            'mensaje' => ['required', 'string', 'min:10', 'max:50']
        ]);
            $email = Auth::user() ? Auth::user()->email : $request->email;
        try {
            Mail::to('support@misitio.org')->send(new ContactoMailable($email, $request->mensaje));
            return redirect() -> route('index') -> with('message','Email enviado correctamente.');
        } catch (Exception $ex) {
            return redirect()->route('index')->with('ERROR', 'No se pudo enviar el mensaje');
        }
    }
}
