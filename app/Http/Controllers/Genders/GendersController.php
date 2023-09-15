<?php

namespace App\Http\Controllers\Genders;

use App\Http\Controllers\Controller;
use App\Models\Genders;
use Illuminate\Http\Request;

class GendersController extends Controller
{

    public function index()
    {
        $genders = Genders::where(['active' => 1])->orderby('id')->paginate(5);

        return view('genders.index', compact('genders'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('genders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        Genders::create($request->all());

        return redirect()->route('genders.index')
            ->with('success', 'Genders created successfully.');
    }


    public function show(Genders $gender)
    {
        return view('genders.view', compact('gender'));
    }


    public function edit(Genders $gender)
    {
        return view('genders.edit', compact('gender'));
    }


    public function update(Request $request, Genders $gender)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $gender->update($request->all());

        return redirect()->route('genders.index')
            ->with('success', 'Gender updated successfully');
    }


    public function destroy(Genders $gender)
    {
        // $gender->update(['active' => 0]);
        return redirect()->route('genders.index')
            ->with('success', 'Gender deleted successfully');
    }
}
