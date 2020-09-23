<?php

namespace App\Http\Controllers;

use App\categorie;
use App\module;
use App\product;
use Illuminate\Http\Request;

class productFrontendController extends Controller
{
    //product tonen op detail pagina
    public function show(product $product)
    {
        /*ophalen gegevens*/
        $categorie_naam = categorie::where('id', $product->categorie_id)->value('categorie_naam');
        $module_naam = module:: where('id', $product->module_id)->value('module_naam');

        /*controlleren of er producten zijn*/
        if (!$product) {
            abort(404);
        }

        /*doorverwijzen naar pagina*/
        return view('/product', [
            'products' => $product,
            'aanmaakdatum' => substr($product->created_at, 0, -16),
            'categorie_naam' => $categorie_naam,
            'module_naam' => $module_naam
        ]);
    }

    //alles tonen op de home pagina
    public function index()
    {
        /*ophalen gegevens*/
        $products = product::all();
        $categories = categorie::all();
        $modules = module::all();

        if (!$products) { /*controlleren of er producten zijn*/
            abort(404);
        }

        /*doorverwijzen naar pagina*/
        return view('/welcome', [
            'products' => $products,
            'modules' => $modules,
            'categories' => $categories

        ]);
    }

    //zoek functie
    public function Search(Request $request)
    {
        /*ophalen gegevens uit zoekfunctie*/
        $find = $request->input('search');
        $categorie = $request->input('categorie');
        $module = $request->input('module');
        $sorteer = $request->input('sorteer');

        if (isset($find)) {  /*zoekbalk*/
            $results = product::where('titel', 'LIKE', '%' . $find . '%')->orWhere('omschrijving', 'LIKE', '%' . $find . '%')->get();
        } else { /* via hamburger menu*/
            if (isset($categorie) && isset($module)) {/*als module en categorie bekend zijn*/
                $results = product::where('categorie_id', $categorie)->where('module_id', $module)->orderBy($sorteer)->get();
            } elseif(isset($module)) {/*als aleen module bekend is*/
                $results = product::where('module_id', $module)->orderBy($sorteer)->get();
            } elseif(isset($categorie)){/*als alleen categorie bekend is*/
                $results = product::where('categorie_id', $categorie)->orderBy($sorteer)->get();
            } else{/*als er niks bekend is*/
                $results = product::all()->sortBy($sorteer);
            }
        }
        /*ophalen van de gegevens*/
        $categories = categorie::all();
        $modules = module::all();

        /*doorverwijzen naar pagina, met gegevens afhankelijk of er restultaten waren*/
        if (count($results) > 0) { /*wel resultaten*/
            return view('welcome', [
                'products' => $results,
                'modules' => $modules,
                'categories' => $categories
            ]);
        } else {/*geen resultaten*/
            return view('welcome', [
                'error' => 'Geen resultaten gevonden.',
                'modules' => $modules,
                'categories' => $categories
            ]);
        }
    }
}
