<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.role_list',['roles'=>Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'bail|required|max:100'
        // ]);

        $validated = $request->validated();
        // $role = new Role();
        // $role->name=$validated['name']; //$request->input('name');
        // $role->save();

        $role = Role::create($validated);

        $request->session()->flash('status','Role added successfully');

        return redirect()->route('role.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.role_edit',['role'=>Role::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRole $request, $id)
    {        
        $validated = $request->validated();
        $role=Role::findOrFail($id);
        $role->fill($validated);
        $role->save();
        $request->session()->flash('status','Role updated successfully');
        return redirect()->route('role.edit', ['role'=>$role->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        //$role=Role::findOrFail($id);
        //$role->delete();
        session()->flash('status','Deleted successfully');
        return redirect()->route('role.index');
    }
}
