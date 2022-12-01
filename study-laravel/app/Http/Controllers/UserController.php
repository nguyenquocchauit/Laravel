<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest('id')->paginate(7);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataCreate = $request->all();
        $dataCreate['password'] = Hash::make($request->password);

        $validator = Validator::make($request->all(), [
            'email' => 'required | email|unique:users,email',
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                'status' => $validator->getMessageBag()->toArray()
            ), 200);
        } else {
            $user = User::create($dataCreate);
            return response()->json([
                'status' => 'Create successfully!'
            ], 200);
        }
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
        $user = User::find($id);
        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
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
        $user = User::find($id);
        $dataUpdate = $request->except('password');
        // if ($request->password) {
        //     return response()->json([
        //         'status' => 'Update password!'
        //     ], 200);
        //     $dataUpdate['password'] = Hash::make($request->password);
        // }
        $validator = Validator::make($request->all(), [
            'email' => 'required | email|unique:users,email,' . $id,
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                'status' => $validator->getMessageBag()->toArray()
            ), 200);
        } else {
            $user->update($dataUpdate);
            return response()->json([
                'status' => 'Update successfully!'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = User::find($id);
        if ($res != null) {
            $res->delete();
            $data = [
                'status' => '1',
                'msg' => 'Success'
            ];
        } else
        if ($res == null) {
            $data = [
                'status' => '0',
                'msg' => 'Fail'
            ];
        }
        return response()->json($data, 200);
    }
}
