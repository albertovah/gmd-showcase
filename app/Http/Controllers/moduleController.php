<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\module;
use App\product;

class moduleController extends Controller
{
    /*index, alles tonen*/
    public function index()
    {
        /*doorverwijzen naar pagina met alle modules*/
        return view('/backend/module', ['modules' => module::all()]);
    }

    //opslaan
    public function store()
    {
        /*opslaan in db*/
        module::create($this->validateModule());

        /*doorverwijzen naar pagina*/
        return redirect('/backend/module')->withInput();
    }

    /*verwijdern*/
    public function destroy(module $module)
    {
        /*controlleren of de gebruiker is ingelogd*/
        if (\Auth::check()) {
            /*ophalen van de producten die bij deze module horen*/
            $resultaat = product::where('module_id', $module->id)->first();
            if (!$resultaat) {
                /*ophalen de te verwijdern module*/
                $delete = module::find($module->id);
                /*verwijderen module*/
                $delete->delete();
                /*doorverwijzen naar pagina*/
                return redirect('/backend/module');
            } else {/*doorverwijzen naar pagina als er nog producten zijn met de modules*/
                return view('/backend/module', ['error' => 'kan module niet verwijderen omdat er nog producten zijn met deze module', 'modules' => module::all()]);
            }
        } else { /*doorverwijzen naar login pagina*/
            return redirect('/login');
        }
    }

    /*update*/
    public function update(module $module)
    {
        /*gegevens in database updaten*/
        $module->update($this->validateModule());

        /*doorverwijzen naar pagina*/
        return redirect('/backend/module')->withInput();
    }

    /*valideren*/
    protected function validateModule()
    {
        /*validatie*/
        return request()->validate([ //validation
            'module_naam' => 'required|unique:modules|max:100'
        ]);
    }

    /*create*/
    public function create()
    {
        /*doorverwijzen naar pagina*/
        return view('/backend/module.create');
    }

    /*edit, bewerken*/
    public function edit(module $module)
    {
        /*doorverwijzen naar pagina*/
        return view('/backend/module.edit', ['module' => $module]);
    }
}

