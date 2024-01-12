<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usergController extends Controller
{
    public function index()
    {
        $userg = User::where('role', 'guru')->orderBy('name', 'ASC')->get();
        return view('userg.index', compact('userg'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('userg.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            // 'role' => 'required',
        ]);
    
        $password = substr($request->email, 0, 3) . substr($request->name, 0, 3);
        $roleGuru="guru";
        try {
            //code...
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $roleGuru,
                'password' => Hash::make($password) // Encrypt the password
            ]);
    return redirect()->back()->with('success', 'Berhasil menambahkan Akun!');

    }catch (\Throwable $th) {

    return redirect()->back()->with('danger','Gagal menambahkan Akun!');
    }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::find($id);

        return view('userg.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',

        ]);
        $password = substr($request->email, 0, 3) . substr($request->name, 0, 3);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('userg.home')->with('success', 'Berhasil mengubah data Pengguna!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('delete', 'Berhasil menghapus data Pengguna!');
    }
}