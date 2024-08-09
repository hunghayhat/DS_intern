<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function storeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:90000'
        ]);

        $user = auth()->user();

        $filename = $user->id . "-" . uniqid() . ".jpg";

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('avatar'));
        $imgData = $image->cover(120, 120)->toJpeg();
        Storage::put('public/avatars/' . $filename, $imgData);

        $oldAvatar = $user->avatar;

        /** @var \App\Models\User $user **/
        $user->avatar = $filename;
        $user->save();

        $this->userRepository->updateAvatar($user, $filename);

        if ($oldAvatar != "/fallback-avatar.jpg") {
            Storage::delete(str_replace("/storage/", "public/", $oldAvatar));
        }
        return back()->with('success', 'Avatar changed successfully!');
    }

    public function showAvatarForm()
    {
        return view('avatar-form');
    }

    public function profile(User $user)
    {
        $currentlyFollowing = $this->userRepository->followStatus(auth()->user(), $user);

        // if (auth()->check()) {
        //     $currentlyFollowing = Follow::where(
        //         [
        //             ['user_id', '=', auth()->user()->id],
        //             ['followeduser', '=', $user->id]
        //         ]
        //     )->count();
        // }


        return view('profile-posts', [
            'currentlyFollowing' => $currentlyFollowing,
            'avatar' => $user->avatar,
            'username' => $user->username,
            'posts' => $user->posts()->latest()->get(),
            'postCount' => $user->posts()->count()
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Logged out!');
    }

    public function showCorrectHomepage()
    {
        if (auth()->check()) {
            return view('homepage-feed');
        } else return view('homepage');
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min: 3', 'max: 20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min: 6', 'confirmed'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/')->with('success', 'Thank you for creating an account!');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required',
        ]);

        if (auth()->attempt(
            [
                'username' => $incomingFields['loginusername'],
                'password' => $incomingFields['loginpassword']
            ]
        )) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You have succeffully logged in!');
        } else {
            return redirect('/')->with('failure', 'Invalid login.');
        }
    }
}
