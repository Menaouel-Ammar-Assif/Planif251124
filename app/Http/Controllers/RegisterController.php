<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function completeProfileForm()
    {
        return view('register.complet_profil');
    }

    public function completeProfile(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'lname' => 'required|string',
        //     'phone' => 'required|integer',
        //     'fax' => 'required|integer',
        // ]);

        $user = auth()->user();

        $name = $request->input('name');
        // $lname = $request->input('lname');
        $matricule = $request->input('matricule');
        $m = User::where('matricule', $matricule)->first();

        $phone = $request->input('phone');
        // $fax = $request->input('fax');

        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');

        if (!$name) {
            return redirect()->back()->with('name_err', 'Nom non renseigné');
        } elseif ($m) {
            return redirect()->back()->with('matricule_err', 'Matricule existe déjà');
        } elseif (!$matricule) {
            return redirect()->back()->with('matricule_err', 'Matricule non renseigné');
        } elseif(!$phone){
            return redirect()->back()->with('phone_err', 'Numéro de téléphone non renseigné');
        }elseif(!$oldPassword) {
            return redirect()->back()->with('old_password_err', 'Le mot de passe actuel non renseigné');
        }elseif(strlen($newPassword) < 2) {
            return redirect()->back()->with('new_password_err', 'Le nouveau mot de passe est court');
        }
        


        if (Hash::check($oldPassword, $user->password)) {
            
            $user->name = $name;
            $user->matricule = $matricule;
            $user->phone = $phone;
            // $user->fax = $fax;
            
            $user->password = Hash::make($newPassword);
            $user->save();

            return redirect("/{$request->user()->role}/dashboard")->with('complet-success', 'Profil complété avec succès !');
        } else {
            return redirect()->back()->with('old_password_err', 'Ancien mot de passe est incorrect');
        }
        
    }

}
