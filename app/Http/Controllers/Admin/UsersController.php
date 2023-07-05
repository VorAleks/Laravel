<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Queries\QueryBuilder;
use App\Queries\UsersQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    protected QueryBuilder $usersQueryBuilder;

    public function __construct(UsersQueryBuilder $usersQueryBuilder)
    {
        $this->usersQueryBuilder = $usersQueryBuilder;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.users.index', [
            'usersList' => $this->usersQueryBuilder->getAll()] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.users.create', [
            'users' => $this->usersQueryBuilder->getAll(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = $request->only(['name', 'email', 'password']);
        $user = User::create($user);
        if ($user !== false) {
            return \redirect()->route('admin.users.index')->with('success', 'User has been create');
        }
        return \back()->with('error', 'User has not been create');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return 0;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return \view('admin.user.edit', [
                'user' => $user,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = $user->fill($request->only(['name', 'email', 'password']));
        if ($user->save()) {
            return \redirect()->route('admin.users.index')->with('success', 'User has been update');
        }
        return \back()->with('error', 'User has not been update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
