<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('role', 'staff')->orderBy('name', 'ASC')->get();
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required',
    ]);

    $password = substr($request->email, 0, 3) . substr($request->name, 0, 3);
    try{
        user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);
    
        return redirect()->back()->with('success', 'Berhasil menambahkan Akun!');

    }catch (\Throwable $th) {

        return redirect()->back()->with('danger','Gagal menambahkan Akun!');
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = user::find($id);
        return view('user.edit', compact('users'));
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

        user::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    
        return redirect()->route('user.home')->with('success', 'Berhasil mengubah data Pengguna!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        user::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

}