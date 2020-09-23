<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\categorie;
use App\product;


class categorieController extends Controller
{

    /*index*/
    public function index()
    {
        /*categories ophalen*/
        $categories = categorie::all();

        /*als er geen categorieen zijn*/
        if (!$categories) {
            abort(404);
        }

        /*doorverwijzen naar aoguna*/
        return view('/backend/categorie', ['categories' => $categories]);
    }

    /*create*/
    public function create()
    {
        /*doorverwijzen naar pagina*/
        return view('backend/categorie.create');
    }

    /*opslaan*/
    public function store()
    {
        /*opslaan in de db*/
        categorie::create($this->validateCategorie());
        /*doorverwijzen naar pagina*/
        return redirect('/backend/categorie')->withInput();
    }

    /*edit*/
    public function edit(categorie $categorie)
    {
        /*doorverwijzen naar view*/
        return view('backend/categorie.edit', ['categorie' => $categorie]);
    }

    /*updaten*/
    public function update(categorie $categorie)
    {
        /*data naar database */
        $categorie->update($this->validateCategorie());
        /*doorverwijzen*/
        return redirect('backend/categorie')->withInput();
    }

    /*verwijderen*/
    public function destroy(categorie $categorie)
    {
        /*controlleren of gebruiker ingelogd is*/
        if (\Auth::check()) {
            /*ophalen van de categorie*/
            $resultaat = product::where('categorie_id', $categorie->id)->first();

            /*controlleren of er producten zijn die bij deze categorie horen*/
            if (!$resultaat) {
                /*als er geen producten zijn, ophalen van de te verwijderen categorie, dan verwijderen*/
                $delete = categorie::find($categorie->id);
                $delete->delete();
                return redirect('/backend/categorie');
            } else {/*als er geen resultaten zijn, */
                $categorie = categorie::all();
                $error = 'kan de categorie niet verwijderen omdat er nog producten zijn met deze categorie.';
                return view('/backend/categorie', ['error' => $error, 'categories' => $categorie]);
            }
        } else { /*als gebruiker niet ingelogd zijn, doorverwijzen naar login pagina*/
            return redirect('/login');
        }
    }

    /*valideren*/
    protected function validateCategorie()
    {
        /*valdideren*/
        return request()->validate([
            'categorie_naam' => 'required|unique:categories|max:100'
        ]);

    }

}

