<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserProfile as ModelsUserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfile extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){   

        $user_id= Auth::user()->id; 
        // dd($user_id);

        // $allprofiles=User::with('profile')->get(); 
        // dd($allprofiles[0]->profile->last_name);
       
        // $profileroles=ModelsUserProfile::with('role')->get();
        // dd($profileroles[0]->role->name);

        $profile_details=User::with(['profile','role'])->whereKey($user_id)->first();
        //dd($profile_details->profile->first_name);
        return view('profile.index',['profile'=> $profile_details]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id){    
        $roles=Role::all();    
        $profile_details=User::with(['profile','role'])->whereKey($id)->first();
        return view('profile.edit',['profile'=> $profile_details, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => "required|alpha_num|max:15|unique:users,name,$id",
            'email' => "bail|required|email|unique:users,email,$id",            
            'mobile' => 'bail|required|digits:10',
            'first_name' => 'bail|required|alpha',
            'last_name' => 'bail|required|alpha',
            'dob' => 'bail|required|date_format:d/m/Y',
            'role' => 'bail|required',            
            'picture' => 'bail|sometimes|required|image|mimes:jpg,jpeg,png'
        ]);

        $hasFile = $request->hasFile('picture');
        $picture_path="";
        if ($hasFile) {
            $file = $request->file('picture');       
            $picture_path=$file->storeAs('picture', 'picture_'.$id.'.'. $file->guessExtension());           
        }

        User::where("id",$id)->update(["name" => $validated['username'],"email" => $validated['email']]);

        $user_profile_data=[
            "mobile" => $validated['mobile'],
            "first_name" => $validated['first_name'],
            "last_name" => $validated['last_name'],
            "dob" => Carbon::createFromFormat('d/m/Y', $validated['dob'])->format('Y-m-d'),
            "role_id" => $validated['role'],
            "picture" => $picture_path
        ];

        if($picture_path==""){
            unset($user_profile_data["picture"]);
        }
        ModelsUserProfile::where("user_id",$id)->update($user_profile_data);

        $request->session()->flash('status','Profile updated successfully');
        return redirect()->route('profile.edit', ['profile'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
