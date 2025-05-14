<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    // Métodos de visualização (mantidos como antes)
    public function login_basic()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-login-basic', ['pageConfigs' => $pageConfigs]);
    }

    public function login_cover()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-login-cover', ['pageConfigs' => $pageConfigs]);
    }

    // Login com JWT
    public function login(Request $request)
    {
        // Validação
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:32',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Erro de validação.'
            ], 422);
        }

        try {
            $credentials = $request->only('email', 'password');

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Credenciais inválidas.'
                ], 401);
            }

            $user = Auth::user();

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'redirect' => route('dashboard-analytics'), // Redirecionamento fixo
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);

        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Não foi possível criar o token.'
            ], 500);
        }
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);
        Auth::login($user);

        return response()->json([
            'success' => true,
            'message' => 'Registro realizado com sucesso!',
            'user' => $user,
            'token' => $token,
            'redirect' => route('dashboard-analytics') // Usando o nome da rota
        ], 201);
    }

    // Esqueci a senha - Envio de email
    public function forgot_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['success' => true, 'message' => __($status)])
            : response()->json(['success' => false, 'message' => __($status)], 400);
    }

    // Reset de senha
    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['success' => true, 'message' => __($status), 'redirect' => '/login'])
            : response()->json(['success' => false, 'message' => __($status)], 400);
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.cover')->with('success', 'Logout realizado com sucesso');
    }

    // Métodos de visualização (mantidos como antes)
    public function register_basic()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-register-basic', ['pageConfigs' => $pageConfigs]);
    }

    public function register_cover()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-register-cover', ['pageConfigs' => $pageConfigs]);
    }

    public function forgot_password_basic()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-forgot-password-basic', ['pageConfigs' => $pageConfigs]);
    }

    public function forgot_password_cover()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-forgot-password-cover', ['pageConfigs' => $pageConfigs]);
    }

    public function reset_password_basic()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-reset-password-basic', ['pageConfigs' => $pageConfigs]);
    }

    public function reset_password_cover()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-reset-password-cover', ['pageConfigs' => $pageConfigs]);
    }

    public function verify_email_basic()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-verify-email-basic', ['pageConfigs' => $pageConfigs]);
    }

    public function verify_email_cover()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-verify-email-cover', ['pageConfigs' => $pageConfigs]);
    }

    public function two_steps_basic()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-two-steps-basic', ['pageConfigs' => $pageConfigs]);
    }

    public function two_steps_cover()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-two-steps-cover', ['pageConfigs' => $pageConfigs]);
    }

    public function register_multi_steps()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/authentication/auth-register-multisteps', ['pageConfigs' => $pageConfigs]);
    }

    // Método auxiliar para determinar o redirecionamento
    protected function determineRedirectPath($user)
    {
        // Lógica personalizada para redirecionamento baseado em roles/permissões
        if ($user->hasRole('admin')) {
            return route('admin.dashboard');
        } elseif ($user->hasRole('manager')) {
            return route('manager.dashboard');
        }

        return route('dashboard-analytics');
    }
}
