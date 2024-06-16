<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repository\Interface\IUserRepository;
use Illuminate\Http\Request; 

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(IUserRepository $iUserRepository)
    {
        $this->userRepository = $iUserRepository;
        // $this->middleware('auth');
    }
    public function all(){
        return response()->json(User::all());
    }
    public function getUserById($id){
        return response()->json(User::findOrFail($id));
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $user['name'] = $data['name'];
        $user['email'] = $data['email'];
        $user['password'] = bcrypt($data['password']);
        $user->save();
        return response()->json(['message' => 'User updated successfully'], 200); 
    }

    public function addUser(UserRequest $userRequest)
    {
        // $data = $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|email',
        //     'password' => 'required|string'
        // ]);
        // User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => $data['password']
        // ]);
        
        $userDto = UserDTO::from($userRequest->all());
        $user = $this->userRepository->createUser($userDto);

        return response()->json(['message' => 'User created successfully'], 201);
    }

}
