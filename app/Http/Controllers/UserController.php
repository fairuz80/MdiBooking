<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Role;
use App\Models\User;
use Laratrust\Models\LaratrustRole;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Rules\MatchOldPassword;
use App\Imports\UsersImport;
use Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        return view('/User/createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'bahagian' => ['required', 'string', 'max:255'],
            'jawatan' => ['required', 'string', 'max:255'],
            'ic' => ['required', 'string', 'max:255'],
            'ext' => ['required', 'string', 'max:255'],
            
        ]);

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bahagian' => $request->bahagian,
            'jawatan' => $request->jawatan,
            'ic' => $request->ic,
            'ext' => $request->ext,
        ]);
        $users->attachRole($request->role_id);

        event(new Registered($users));

        //Auth::login($users);
        return redirect('/User/listUser')->with('alert', 'Maklumat pengguna telah diwujudkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function showUser(User $user)
    {
        $users = Auth::user();
       
        if ($users->hasRole('admin') )  {
            
            $users = User::orderBy('id', 'desc')
            ->paginate(20);
        
        }
        
        else {
        
        $users = User::orderBy('id', 'desc')
        ->paginate(20);
        }

        return view ('/User/listUser', compact('user', 'users'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editUserPass($id)
    {
        $pass = User::find($id); 
        return view ('/User/editUserPass', ['pass'=>$pass]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateUserPass(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'password' => 'required|min:8|confirmed',
        ]);

        $pass = User::find($request->id);

        if ($pass) {
            $pass->password = Hash::make($request->password);
            $pass->save();

            return redirect('/User/listUser')->with('alert', 'Katalaluan telah dikemaskini.');
        } else {
            return redirect('/User/listUser')->with('alert', 'Ralat.');
        }
    }

    public function editUserBio($id)
    {
        $data = User::find($id); 
        return view ('/User/editUserBio', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateUserBio(Request $request, User $user)
    {
       
        $data = User::find($request->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->bahagian = $request->bahagian;
        $data->jawatan = $request->jawatan;
        $data->ic = $request->ic;
        $data->ext = $request->ext;
        $data->roles()->detach();
        
        $data->save();
        
        $data->attachRole($request->role_id);

        return redirect('/User/listUser')->with('alert', 'Maklumat pengguna telah dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($id)
    {
        $users = User::find($id);
        $users != null;
        $users->delete();

        return redirect('/User/listUser')->with('alert', 'Maklumat pengguna telah dipadamkan.');
    }

    public function createUserExcel()
    {
        return view('/User/createUserExcel');
    }

    public function saveUserExcel(Request $request)
    {
        Excel::import(new UsersImport, $request->file);
        return redirect()->route('list.User')->with('alert', 'Muat Naik telah berjaya.');
    }


}
