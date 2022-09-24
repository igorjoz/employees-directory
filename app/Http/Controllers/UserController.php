<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use App\Models\User;
use App\Rules\ProperImageRatio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Intervention;

class UserController extends Controller
{
    // * create name for an uploaded image
    protected function createImageName($image)
    {
        $fileExtension = $image->getClientOriginalExtension();

        return time() . '-' . Str::random(12) . '.' . $fileExtension;
    }


    // * handle uploaded image
    protected function handleImage($image, $user, $isEdit = false)
    {
        if ($isEdit and $user->image_path != "storage/img/user/dummy-profile-picture.png") {
            Storage::delete($user->image_path);
        }

        $imageName = $this->createImageName($image);

        $image = Intervention::make($image);

        $image->orientate()->resize(1500, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save('storage/img/user/' . $imageName, 80);

        $imagePath = "public/img/user/" . $imageName;

        request()->merge(['image_path' => $imagePath]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = request()->query('filter');

        if (!empty($filter)) {
            $users = User::sortable()
                ->where('name', 'like', '%' . $filter . '%')
                ->orWhere('surname', 'like', '%' . $filter . '%')
                ->orWhere('email', 'like', '%' . $filter . '%')
                ->orWhere('description', 'like', '%' . $filter . '%')
                ->paginate(25);
        } else {
            $users = User::withCount('departments')
                ->sortable()
                ->paginate(25);
        }


        return view(
            'user.index',
            [
                'users' => $users,
                'filter' => $filter,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = request('user');
        $password = request('password');

        request()->validate([
            'name' => ['required', 'max:100'],
            'surname' => ['required', 'max:100'],
            'password' => ['required', 'min:6', 'max:255'],
            'description' => ['required', 'max:1000000'],
            'phone_number' => ['required', 'max:14'],
            'email' => ['required', 'email:rfc,dns', 'unique:users', 'max:255'],
            'image' => 'required',
        ]);
        $hashedPassword = Hash::make($password);

        if (!is_null(request('image'))) {
            request()->validate([
                'image' => [
                    'required',
                    'image',
                    'max:15360',
                    new ProperImageRatio(request('image')),
                ],
            ]);

            $image = request('image');
            $this->handleImage($image, $user);
        } else {
            request()->merge(['image_path' => 'img/user/dummy-profile-picture.png']);
        }

        $user = User::create([
            'name' => request('name'),
            'surname' => request('surname'),
            'description' => request('description'),
            'phone_number' => request('phone_number'),
            'email' => request('email'),
            'image_path' => request('image_path'),
            'password' => $hashedPassword,
        ])->assignRole('employee');

        Mail::to($user->email)
            ->send(new UserCreated($user, $password));

        return redirect()->route('user.index')
            ->with('flashMessage', 'Dodano użytkownika "' . $user->name . " " . $user->surname . '"');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view(
            'user.show',
            [
                'user' => $user,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (request()->route()->getName() == "user.edit_account") {
            $userId = Auth::user()->id;
            $user = User::findOrFail($userId);
        }

        return view(
            'user.edit',
            [
                'user' => $user,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (request()->route()->getName() == "user.update_account") {
            $userId = Auth::user()->id;
            $user = User::findOrFail($userId);
        }

        $validated = request()->validate([
            'name' => ['required', 'max:100'],
            'surname' => ['required', 'max:100'],
            'description' => ['required', 'max:1000000'],
            'phone_number' => ['required', 'max:14'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
        ]);

        if (!is_null(request('image'))) {
            request()->validate([
                'image' => [
                    'required',
                    'image',
                    'max:15360',
                    new ProperImageRatio(request('image')),
                ],
            ]);

            $image = request('image');
            $this->handleImage($image, $user, true);
        } else {
            request()->merge(['image_path' => 'img/user/dummy-profile-picture.png']);
        }

        $validated = array_merge($validated, ['image_path' => request('image_path')]);

        $user->update($validated);

        return redirect()->route('user.show', $user->id)
            ->with('flashMessage', 'Zmodyfikowano użytkownika o id "' . $user->id . '"');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $userNameAndSurname = $user->name . " " . $user->surname;
        $user->delete();

        return redirect()->route('user.index')
            ->with('flashMessage', 'Usunięto użytkownika "' . $userNameAndSurname . '"');
    }
}
