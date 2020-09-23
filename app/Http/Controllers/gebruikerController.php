<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;


class gebruikerController extends Controller
{
    //show all, index
    public function index()
    {
        /*controlleren of gebruiker een admin is*/
        $this->authorize('edit-users');

        /*ophalen van alle gebruikers*/
        $user = User::all();

        /*als er geen gebruikers zijn,*/
        if (!$user) {
            abort(404);
        }

        /*doorverwijzen naar pagina*/
        return view('/backend/gebruiker', ['gebruikers' => $user]);
    }

    //create new, create
    public function create()
    {
        /*controlleren of de ingelogde gebruiker een admin is*/
        $this->authorize('edit-users');

        /*naar pagina verwijzen*/
        return view('/backend/gebruiker.create');
    }

    /*store opslaan*/
    public function store(request $request)
    {
        /*controllern of de ingelogde gebruiker een admin is*/
        $this->authorize('edit-users');

        /*valideren*/
        $request->validate([
            'name' => 'required|string',
            'password' => 'min:8|required',
            'email' => 'required||unique:users|email|max:255',
        ]);

        /*gebruiker aanmaken, dan vullen met gegevens, dan opslaan in db*/
        $user = new User();
        $user->email = request('email');
        $user->admin = request('admin');
        $user->name = request('name');
        $user->password = hash::make($request->get('password'));
        $user->save();

        /*doorverwijzern naar pagina*/
        return redirect('/backend/gebruiker')->withInput();
    }

    /*bewerken*/
    public function edit(user $user)
    {
        /*controlleren of de gebruiker een adim is*/
        $this->authorize('edit-users');

        /*doorverwijzen naar pagina*/
        return view('/backend/gebruiker.edit', ['user' => $user]);
    }

    /*update*/
    public function update(request $request, user $user)
    {
        /*controlleren of de gebruiker een admin is*/
        $this->authorize('edit-users');

        /*valideren van gegevens*/
        $request->validate([
            'password' => 'min:8',
        ]);

        /*todo controlleren*/
        /*als het om role*/ /*werkt dit?*/
        $user->password = hash::make($request->get('password'));

        /*opslaan van de gegevens*/
        $user->save();

        /*doorverwijzen naar pagina*/
        return redirect('/backend/gebruiker')->withInput();
    }


    /*update admin naar false*/
    public function updateAdminFalse(user $user)
    {
        /*controlleren of gebruiker een admin is*/
        $this->authorize('edit-users');

        /*updaten van de DB*/
        User::where('id', $user->id)->update(['admin' => 1]);

        /*ophalen gegevens*/
        $users = User::all();

        /*doorverwijzen naar pagina*/
        return view('/backend/gebruiker', ['gebruikers' => $users]);
    }

    /*update admin naar true*/
    public function updateAdminTrue(user $user)
    {
        /*controlleren of gebruiker een admin is*/
        $this->authorize('edit-users');
        /*huidige gebruiker ophalen, voor te controlleren of de huidige gebruiker niet de te verwijderen gebruiker is.*/
        $loggedIn = Auth::user();

        /*de te updaten gebruiker */
        $update = User::find($user->id);

        /*als de de te updaten gebruiken overeen komt met de huidige gebruiker*/
        if ($loggedIn == $update) {
            /*doorverwijzen naar pagina*/
            return view('/backend/gebruiker', [
                'error' => "Niet mogelijk om admin rechten bij je eigen account weg te halen", 'gebruikers' => User::all()
            ]);
        } else {/*als ze niet overeen komen, */
            /*updaten in de db*/
            User::where('id', $user->id)->update(['admin' => 0]);
            /*ophalen gegevens*/
            $users = User::all();
            /*doorbverwijzen naar pagina*/
            return view('/backend/gebruiker', ['gebruikers' => $users]);
        }
    }

    /*valideren*/
    protected function validateGebruiker()
    {
        /*validatie*/
        return request()->validate([
            'name' => 'required|string',
            'password' => 'min:8',
            'email' => 'required||unique:users|email|max:255',
        ]);
    }

    /*verwijderen*/
    public function destroy(user $user)
    {
        /*controlleren of de huidige gebruiker een admin is*/
        $this->authorize('edit-users');

        /*ophalen van de hudige gebruiker*/
        $loggedIn = Auth::user();

        /*ophalen van de te verwijderen gebruiker*/
        $delete = User::find($user->id);

        /*controlleren of de huidige gebruiker de te verwijderen gebruiker is*/
        if ($loggedIn == $delete) {
           /*doorverwijzen naar pagina*/
            return view('/backend/gebruiker', [
                'error' => "Niet mogelijk om je eigen account te verwijderen.",
                'gebruikers' => User::all()
            ]);
            /*als de te verwijderen gebruiker een admin is, kan niet verwijderen*/
        } else if ($delete->admin == "1") {
          /*doorverwijzen naar paigina*/
            return view('/backend/gebruiker', [
                'error' => "Kan gebruiker niet verwijderen omdat deze een admin is.",
                'gebruikers' =>  User::all()
            ]);
        } else { /*verwijderen*/
            /*verwijderen uit DB*/
            $delete->delete();
            /*doorverwijzen naar pagina*/
            return redirect('/backend/gebruiker');
        }
    }
}
