<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/Index', [
            'users' => User::all()
        ]);
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
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:users,name'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:8']
        ]);

        if ($validation->fails()) {
            request()->session()->flash('error', $validation->errors()->first());
            return Redirect::route('users.index');
        }

        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($user) {
            request()->session()->flash('success', 'New user added successfully.');
            return Redirect::route('users.index');
        } else {
            request()->session()->flash('error', 'Ops! Could not add user, please try again');
            return Redirect::route('users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return Inertia::render('User/Show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        request()->session()->flash('success', 'User account has been deactivated');
        return Redirect::route('users.index');
    }

    public function check()
    {
        return "Hello";
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
        // return (new UsersExport)->download('users.csv', \Maatwebsite\Excel\Excel::CSV, [
        //     'Content-Type' => 'text/csv',
        // ]);
        // return (new UsersExport)->download('users.xls');
        // return (new UsersExport)->download('users.xls', Excel::CSV, ['Content-Type' => 'text/csv']);

    }
}
