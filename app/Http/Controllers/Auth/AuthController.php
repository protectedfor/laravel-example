<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Event;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function postSocialAuth(Request $request)
    {
        $token = $request->get('token');
        $s = file_get_contents('http://ulogin.ru/token.php?token=' . $token . '&host=' . $_SERVER['HTTP_HOST']);
        $social_user = json_decode($s, true);
        $email = array_get($social_user, 'email');
        $user = User::where('email', $email)->first();
        if (!$user) {
            $created_user = User::create([
                'name' => array_get($social_user, 'first_name'),
                'email' => array_get($social_user, 'email'),
                'password' => '',
                'photo' => array_get($social_user, 'photo_big'),
                'uid' => array_get($social_user, 'uid'),
                'network' => array_get($social_user, 'network'),
                'identity' => array_get($social_user, 'identity'),
            ]);
        }
        Auth::login($user);
        return redirect()->route('home');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        $user = User::where('email', array_get($credentials, 'email'))->first();
        if (!$user->activated) {
            Session::flash('error', "Пользователь не активирован! Для повторной отправки письма пройдите по <a href=" . route('auth.send_activation', ['user_id' => $user->id]) . ">ссылке</a>");
            return redirect('auth/login');
        }

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    public function sendActivation(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            Session::flash('error', 'Пользователь не найден');
            return redirect('auth/login');
        }
        $user['activation_token'] = $user->activation_token;


        $diff = Carbon::now()->diffInSeconds($user->activation_request_date);

        if($diff < config('app.activation_code_limit')){
            Session::flash('error', 'Для повторной отправки письма нужно подождать ' . (config('app.activation_code_limit') - $diff) . ' ' . trans_choice('секунд|секунды|секунду', (config('app.activation_code_limit') - $diff)));
            return redirect('auth/login');
        }

        $user->activation_request_date = Carbon::now();
        $user->save();

        Event::fire(new UserRegisteredEvent($user));

        Session::flash('success', 'Ссылка с инструкцией по активации отправлена на ' . $user->email);
        return redirect('auth/login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $token = str_random();
        $request->merge([
            'activation_token' => $token,
            'password' => Hash::make($request->get('password'))
        ]);

//        dd($request->all());

        $user = User::create($request->all());

        $user['activation_token'] = $token;

        Event::fire(new UserRegisteredEvent($user));

        Session::flash('success', 'Инструкция по активации аккаунта отправлена на e-mail: ' . $user->email);

        return redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    public function activate(Request $request)
    {
        $token = $request->get('token');
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            Session::flash('error', 'Пользователь не найден!');
            return redirect()->route('home');
        }
        if ($user->activated) {
            Session::flash('success', 'Пользователь уже активирован!');
            return redirect()->route('home');
        }

        $user->activated = true;
        $user->activation_token = null;
        $user->save();
        Session::flash('success', 'Пользователь успешно активирован!');
        Auth::login($user);
        return redirect()->route('home');
    }
}
