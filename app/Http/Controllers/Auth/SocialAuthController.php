<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            $user = User::where('email', $socialUser->getEmail())->first();
            
            if ($user) {
                if (empty($user->{"{$provider}_id"})) {
                    $user->update([
                        "{$provider}_id" => $socialUser->getId()
                    ]);
                }
            } else {
                $username = match($provider) {
                    'github' => $this->generateGithubUsername($socialUser),
                    'google' => $this->generateGoogleUsername($socialUser),
                    default => $this->generateDefaultUsername($socialUser)
                };

                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'username' => $username,
                    'profile_image' => $socialUser->getAvatar(),
                    'email_verified_at' => now(),
                    'password' => bcrypt(str()->random(16)),
                    "{$provider}_id" => $socialUser->getId(),
                ]);
            }

            Auth::login($user);

            return redirect()->intended('/');
            
        } catch (\Exception $e) {
            \Log::error('Social Auth Error: ' . $e->getMessage());
            return redirect()->route('auth')
                ->with('error', 'Произошла ошибка при авторизации через ' . ucfirst($provider));
        }
    }

    private function generateGithubUsername($socialUser)
    {
        $username = $socialUser->getNickname();
        return $this->ensureUniqueUsername($username);
    }

    private function generateGoogleUsername($socialUser)
    {
        $emailParts = explode('@', $socialUser->getEmail());
        $username = $emailParts[0];
        
        if (in_array($username, ['admin', 'user', 'test'])) {
            $namePart = str_replace(' ', '', strtolower($socialUser->getName()));
            $username = $username . '_' . substr($namePart, 0, 5);
        }
        
        return $this->ensureUniqueUsername($username);
    }

    private function generateDefaultUsername($socialUser)
    {
        $username = $socialUser->getNickname() 
            ?? str_replace(' ', '', strtolower($socialUser->getName()))
            ?? explode('@', $socialUser->getEmail())[0];
            
        return $this->ensureUniqueUsername($username);
    }

    private function ensureUniqueUsername($username)
    {
        $username = preg_replace('/[^A-Za-z0-9_]/', '', $username);
        
        if (empty($username) || strlen($username) < 4) {
            $username = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 4) . rand(100, 999);
        }
        
        $originalUsername = $username;
        $counter = 1;
        
        while (User::where('username', $username)->exists()) {
            $username = $originalUsername . $counter;
            $counter++;
        }
        
        return $username;
    }
}
