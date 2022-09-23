<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\ProperImageRatio;
use Illuminate\Http\Request;
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
    protected function handleImage($image)
    {
        $user = request('user');

        if ($user->image_path != "storage/img/user/dummy-profile-picture.jpg") {
            Storage::delete($user->image_path);
        }

        $imageName = $this->createImageName($image);

        $image = Intervention::make($image);

        $image->orientate()->resize(1500, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save('storage/img/user/' . $imageName, 70);

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
        $users = User::withCount('departments')->get();

        return view(
            'user.index',
            [
                'users' => $users,
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
        //
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
        }

        $image = request('image');
        $this->handleImage($image);
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
        //
    }
}
