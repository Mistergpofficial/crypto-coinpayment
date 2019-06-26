<?php

namespace App\Http\Controllers;
//use App\Models\Notification;
use App\Notifications\NotifyUser;
use App\User;
use App\Models\Link;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function showRegistrationForm()
    {
        return view('pages.auth.register');
    }

    public function ntui(Request $request){
        $user = $request->query('ref');
        return view('pages.auth.ref_register', compact('user'));
    }

    //registration with referral link

    public function postRegistrationForm(Request $req)
    {
        $data = $req->all();
        $this->validation($req);
        $user = new User();
        $user->full_name = $data['full_name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->phone = $data['phone'];
        $user->bitcoin = $data['bitcoin'];
        $user->upline = $data['upline'];
        $user->role_id = 1;
        $user->save();

        $ref = 'https://cryptotraderslab.com/account/register?ref=';

        Link::create([
            'user_id' => $user->id,
            'username' => $user->username,
            'address' => $ref.''.$user->username
        ]);

        $link = Link::where('username', $data['upline'])->first();
        //$web = $link->user()->get();
        //Log::info($web);
      //  User::find($link->user->id)->notify(new NotifyUser($link));
        $link->user->notify(new NotifyUser($link));



        //$link = Link::find($)


       // $user = User::where('username', $user->upline)->get();
       // \Log::info($user);
       // dd($user);
        //User::find($user->id)->notify(new NotifyUser($user));


       /* Notification::create([
           'user_id' => $user->id,
            'user_full_name' => $user->full_name,
            'upline_username' => $user->upline,
            'status' => 1,
            'note' => 'registered with your unique link'
        ]);*/

       session()->flash('success', 'User created successfully!.');
        return redirect()->back();


    }

    //registration without referral link

    public function postRegistration(Request $request)
    {

        $this->validate($request,[
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required',
            'username' => 'required|unique:users,username',
            'bitcoin' => 'required',
        ]);
        $data = $request->all();
        $user = new User();
        $user->full_name = $data['full_name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->phone = $data['phone'];
        $user->bitcoin = $data['bitcoin'];
        $user->role_id = 1;
        $user->save();

        $ref = 'https://cryptotraderslab.com/account/register?ref=';

        Link::create([
            'user_id' => $user->id,
            'username' => $user->username,
            'address' => $ref.''.$user->username
        ]);


        //$link = Link::find($)


        // $user = User::where('username', $user->upline)->get();
        // \Log::info($user);
        // dd($user);
        //User::find($user->id)->notify(new NotifyUser($user));

        return $user;


    }

    public function validation($req)
    {
        return $this->validate($req, [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required',
            'username' => 'required|unique:users,username',
            'upline' => 'required|exists:users,username',
            'bitcoin' => 'required',
        ]);
    }
}
