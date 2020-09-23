<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use App\product;
use App\categorie;
use App\module;
use App\Traits\UploadTrait;

class productController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //alles tonen op de backend pagina
    public function index()
    {
        $products = product::join('modules', 'modules.id', '=', 'products.module_id')
            ->join('categories', 'categories.id', '=', 'products.categorie_id')
            ->select('products.*', 'modules.module_naam', 'categories.categorie_naam')
            ->get()->sortBy('id');

        $categories = categorie::all();
        $modules = module::all();


        if (!$products) {
            abort(404);
        }
        return view('/backend/product', [
            'products' => $products,
            'categories' => $categories,
            'modules' => $modules,
        ]);
    }

    /*zoek functie*/
    public function search(Request $request)
    {

        /*ophalen gegevens uit zoekfunctie*/
        $categorie = $request->input('categorie');
        $module = $request->input('module');
        $sorteer = $request->input('sorteer');

        /*ophalen van de gegevens*/
        $categories = categorie::all();
        $modules = module::all();

        //dd($find);

        if (isset($categorie) && isset($module)) {/*als module en categorie bekend zijn*/
            $results = product::select('products.*', 'modules.module_naam', 'categories.categorie_naam')
                ->join('modules', 'modules.id', '=', 'products.module_id')
                ->join('categories', 'categories.id', '=', 'products.categorie_id')
                ->where('categorie_id', $categorie)
                ->where('module_id', $module)
                ->orderBy($sorteer)->get();
        } elseif (isset($module)) {/*als aleen module bekend is*/
            $results = product::select('products.*', 'modules.module_naam', 'categories.categorie_naam')
                ->join('modules', 'modules.id', '=', 'products.module_id')
                ->join('categories', 'categories.id', '=', 'products.categorie_id')
                ->where('module_id', $module)
                ->orderBy($sorteer)->get();
        } elseif (isset($categorie)) {/*als alleen categorie bekend is*/
            $results = product::select('products.*', 'modules.module_naam', 'categories.categorie_naam')
                ->join('modules', 'modules.id', '=', 'products.module_id')
                ->join('categories', 'categories.id', '=', 'products.categorie_id')
                ->where('categorie_id', $categorie)->orderBy($sorteer)->get();
        } else {/*als er niks bekend is*/
            $results = product::select('products.*', 'modules.module_naam', 'categories.categorie_naam')
                ->join('modules', 'modules.id', '=', 'products.module_id')
                ->join('categories', 'categories.id', '=', 'products.categorie_id')
                ->get()->sortBy($sorteer);
        }


        /*terug naar webstie*/
        return view('/backend/product', ['products' => $results, 'categories' => $categories, 'modules' => $modules]);
    }

    //product tonen op detail pagina van backend
    public
    function show(product $product)
    {
        if (!$product) { /*controlleren of er producten zijn*/
            abort(404);
        }

        /*naar view verwijzen*/
        return view('/backend/product/show', [
            'products' => $product
        ]);
    }

    //product toevoegen
    public function create()
    {
        /*doorverwijzen naar pagina*/
        return view('/backend/product.create', [
            'modules' => module::all(),
            'categories' => categorie::all()
        ]);
    }

    //opslaan
    public function store(Request $request)
    {
        /*valideren*/
        $this->validateProduct();

        /*product in db zetten*/
        $product = new Product(request(['titel', 'omschrijving', 'leerlingen', 'link', 'categorie_id', 'module_id']));

        /*opslan*/
        $product -> save();

        /*id ophalen*/
        $id = $product->id;

        /*ophalen ID*/
        /*nieuwe afbeelding uploaden*/
        if ($request->hasfile('afbeelding')) {
            $name = $id . '.' . $request->file('afbeelding')->getClientOriginalExtension();//Get a file name with the extension
            $this->uploadOne($request->file('afbeelding'), 'uploadedImages/', 'public', $name);// Upload image
            product::where('id', $id)->update(['afbeelding' => $name]);
        }

        /*doorverwijzen naar pagina*/
        return redirect('backend/product')->withInput();
    }

    /*edit*/
    public function edit(product $product)
    {
        /*ophalen gegevens*/
        $categories = categorie::all();
        $modules = module::all();
        $categorie = categorie::where('id', $product->categorie_id)->first();
        $module = module:: where('id', $product->module_id)->first();

        /*doorverwijzen naar pagina*/
        return view('/backend/product.edit', [
            'product' => $product,
            'categories' => $categories,
            'modules' => $modules,
            'categorie' => $categorie,
            'module' => $module
        ]);
    }

    //updaten
    public function update(product $product, request $request)
    {
        /*valideren*/
        $this->validateProduct();

        /*product updaten*/
        $product->update(request(['titel', 'omschrijving', 'leerlingen', 'link', 'categorie_id', 'module_id']));

        /*id ophalen*/
        $id = request('id');

        /*ophalen ID*/
        /*nieuwe afbeelding uploaden*/
        if ($request->hasfile('afbeelding')) {
            $name = $id . '.' . $request->file('afbeelding')->getClientOriginalExtension();//Get a file name with the extension
            $this->uploadOne($request->file('afbeelding'), 'uploadedImages/', 'public', $name);// Upload image
            if ($request->input('HeeftAfbeelding') != 'ja') { /*als er geen afbeelding is dan toevoegen in database*/
                product::where('id', $id)->update(['afbeelding' => $name]);
            }
        } elseif (request('imageStatus') == 'deleteImage') { /*controlleren of afbeelding verwijderd moet worden*/
            //afbeelding verwijderen uit map
            $path = 'app/public/uploadedImages' . $product->afbeelding;

            /*verwijderen van afbeelding op 2 manieren*/
            Storage::delete($path);
            unlink(storage_path('app/public/uploadedImages/' . $product->afbeelding));

            //Bijlage uit database verwijderen
            product::where('id', $id)->update(['afbeelding' => '']);
        }

        /*doorverwijzen naarp pagina*/
        return redirect('backend/product')->withInput();
    }

    /*validatie*/
    protected function validateProduct()
    {
        /*valideren*/
        return request()->validate([ //validation
            'titel' => 'required|max:50',
            'omschrijving' => 'required',
            'afbeelding' => 'image|max:1999|mimes:jpeg,png,jpg,gif',
            'leerlingen' => 'max:100',
            'link' => 'nullable | max:50',
            'module_id' => 'required',
            'categorie_id' => 'required'
        ]);
    }

    //verwijderen
    public  function destroy(product $product)
    {
        //controlleren of er een gebruiker ingelogd is
        if (\Auth::check()) {

            /*product ophalen om te kunnen te verwijderen*/
            $product = product::find($product->id);

            //controlleren of product een afbeelding heeft. Zo ja, dan word de afbeelding in de if verwinderd
            if (!empty($product->afbeelding)) {
                //path ophalen
                $path = 'storage/app/public/uploadedImages/' . $product->afbeelding;

                /*verwijderen van afbeelding op 2 manieren*/
                Storage::delete($path);
                unlink(storage_path('app/public/uploadedImages/' . $product->afbeelding));

            }
            /*verwijderen van apparatuur*/
            $product->delete();

            /*doorverwijzen*/
            return redirect('/backend/product');

        } else {/*als gebruiker niet ingelogd is*/
            return redirect('/login');
        }
    }
}

