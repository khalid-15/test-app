<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        $data = Company::get();
        return inertia::render('Admin/Companies/index', ['companies' => $data]);
    }

    public function create()
    {
        return inertia::render('Admin/Companies/create');
    }
    public function store(Request $request)
    {
        // Create record
        $request->validate([
            'name' => ['required'],
            'tax_number' => ['required'],
            'sector' => ['required']
        ]);

        Company::create(['name' => $request->name, 'tax_number' => $request->tax_number, 'sector' => $request->sector]);
        $msg = 'Entreprise Créer avec succès';
        $status = '201';
        return redirect('/admin/companies')->with('message' , $msg)->with('status' , $status);
    }
    public function edit($id)
    {
        $company = Company::find($id);
        return inertia::render('Admin/Companies/edit' , ['company' => $company]);
    }
    public function update(Request $request)
    {
        // Create record
        $request->validate([
            'id'=> ['required'],
            'name' => ['required'],
            'tax_number' => ['required'],
            'sector' => ['required']
        ]);
        try {
            $company = Company::find($request->id);
            $company->update(['name' => $request->name, 'tax_number' => $request->tax_number, 'sector' => $request->sector]);
            $company->save();
            $msg = 'Entreprise mis a jour avec succès';
            $status = '201';
        } catch (\Throwable $th) {
            $msg = 'Erreur Serveur';
            $status = '400';
        }
        return redirect('/admin/companies')->with('message' , $msg)->with('status' , $status);
    }

    public function delete($id)
    {
        $company = Company::where('id', '=', $id)->withCount('employees')->first();
        if($company->employees_count == 0){

            $company->delete();
            $msg = 'Entrperise Supprimer';
            $status = '201';
        }else{
            $msg = 'Cette entreprise ne peut pas etre supprimer';
            $status = '400';
        }
        return redirect('/admin/companies')->with('message' , $msg)->with('status' , $status);
    }

}
