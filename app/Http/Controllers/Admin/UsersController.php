<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Store;
use App\Http\Requests\Users\Update;
use App\Models\User;
use App\Queries\QueryBuilder;
use App\Queries\UsersQueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request): RedirectResponse
    {
        $data = $request->validated();
        if (isset($data['isAdmin'])) {
            $data['isAdmin'] = true;
        }

        $user = User::create($data);

        if ($user) {
            return \redirect()->route('admin.users.index')->with('success', __('User has been created'));
        }
        return \back()->with('error', __('User has not been created'));
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
        return \view('admin.users.edit', [
                'user' => $user,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, User $user)
    {
        $data = $request->validated();

        (isset($data['isAdmin'])) ? $data['isAdmin'] = true : $data['isAdmin'] = false;

        if ($data['password'] !== $data['password-confirm']) {
            return \back()->with('error', __('Do not match password in two lines.'));
        } else {
            unset($data['password-confirm']);
        }

        $data = array_filter($data, static function($var){return $var !== null;} );
        dd($data, $user);
        $user = $user->fill($data);
        if ($user->save()) {
            return \redirect()->route('admin.users.index')->with('success', __('User has been updated'));
        }
        return \back()->with('error', __('User has not been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            return \response()->json('ok');
        } catch (\Throwable $exception) {
            \log::error($exception->getMessage(), $exception->getTrace());

            return \response()->json('error', 400);
        }
    }
}
