<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    // Отобразить список всех пользователей
    public function index()
    {
        $users = User::all();
        // return response()->json($users);
        return view('pages.users.index', compact('users'));
    }

    // Отобразить форму для создания нового пользователя
    public function create()
    {
        return view('pages.users.create');
    }

    // Сохранить нового пользователя
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'string|max:255',
            'avatar' => 'nullable',
            'phone' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'note'=> 'nullable'
        ]);
        $user = User::create($request->only(['name','note','role','email','phone','password']));
        // if($request->file('avatar')){
        //     $imagePath = $request->file('avatar')->store('images', 'public');
        //     $user->avatar = $imagePath;
        // }
        // $user->save();
        return redirect('/users')->with('success', 'Пользователь успешно создан.');
    }

    // Отобразить информацию о пользователе
    public function show(User $user)
    {
        return view('pages.users.show', compact('user'));
    }

    // Отобразить форму для редактирования пользователя
    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    // Обновить пользователя
    public function update(Request $request, User $user)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable',
            'role' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'note' => 'nullable'
        ]);

        // Обновление данных пользователя
        $user->name = $validatedData['name'];
        $user->role = $validatedData['role'];
        $user->phone = $validatedData['phone'];
        $user->email = $validatedData['email'];
        $user->note = $validatedData['note'];
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        // if($request->file('avatar')){
            //     $imagePath = $request->file('avatar')->store('images', 'public');
            //     $user->avatar = $imagePath;
            // }
        $user->save();

        return redirect('/users')->with('success', 'Пользователь успешно обновлен.');
    }

    // Удалить пользователя
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success', 'Пользователь успешно удален.');
    }
}
