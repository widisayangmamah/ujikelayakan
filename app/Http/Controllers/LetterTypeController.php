<?php

namespace App\Http\Controllers;

use App\Models\letter_type;
use Illuminate\Http\Request;
use App\Exports\LettertypeExport;

class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lettertypes = letter_type::withCount('letterType')->get();
        return view('lettertypes.index', compact('lettertypes'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('lettertypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'letter_code' => 'required|max:5',
            'name_type' => 'required'
        ]);

        $existingCount = letter_type::orderBy('id', 'DESC')->first();

        $letterCode = $request->letter_code . '-' . ($existingCount['id'] + 1);

        letter_type::create([
            'letter_code' => $letterCode,
            'name_type' => $request->name_type
        ]);
        return redirect()->route('lettertype.create')->with('success', 'Surat berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(letter_type $letter_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lettertype = letter_type::find($id);
        return view ('lettertypes.edit', compact('lettertype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_type' => 'required|min:4',
        ]);
    
        $existingCount = letter_type::where('id', $id)->value('letter_code');
    
    
        preg_match('/-(\d+)$/', $existingCount, $matches);
    
    
        if (!empty($matches[1])) {
            $numericPart = $matches[1];
        } else {
                
            $numericPart = 0; 
        }
    
        $letterCode = $request->letter_code . '-' . $numericPart;
    
    
        letter_type::where('id', $id)->update([
            'letter_code' => $letterCode,
            'name_type' => $request->name_type,
        ]);
        
    
    
        return redirect()->route('lettertype.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        letter_type::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}