<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Ajout de la facade Validator
use App\Models\User; // Assurez-vous d'importer le modèle User
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register'); // Syntaxe de la fonction view() corrigée
    }

    public function registersave(Request $request)
    {
        // Correction des règles de validation et ajout de la règle 'confirmed' pour le mot de passe
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Assurez-vous de vérifier l'unicité de l'email
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Utilisation de la fonction bcrypt pour hacher le mot de passe
            'level' => 'Admin',
        ]);

        return redirect()->route('dashboard');
    }

    public function login()
    {
        return view('auth.login'); // Nom de la vue corrigé
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // L'authentification a réussi
            return redirect()->route('dashboard');
        }

        // L'authentification a échoué, redirigez avec un message d'erreur
        return redirect()->route('login')->withErrors(['email' => 'Les informations d\'identification sont incorrectes.']);
    }
}
