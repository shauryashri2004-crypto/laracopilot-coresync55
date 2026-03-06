<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    private array $credentials = [
        'admin@canteen.com'    => ['password' => 'admin123',    'role' => 'Admin',   'name' => 'Canteen Admin'],
        'staff@canteen.com'    => ['password' => 'staff123',    'role' => 'Staff',   'name' => 'Canteen Staff'],
        'manager@canteen.com'  => ['password' => 'manager123',  'role' => 'Manager', 'name' => 'Canteen Manager'],
    ];

    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $email = $request->email;

        if (isset($this->credentials[$email]) &&
            $this->credentials[$email]['password'] === $request->password) {
            session([
                'admin_logged_in' => true,
                'admin_user'      => $this->credentials[$email]['name'],
                'admin_email'     => $email,
                'admin_role'      => $this->credentials[$email]['role'],
            ]);
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, ' . $this->credentials[$email]['name'] . '!');
        }

        return back()->withErrors(['email' => 'Invalid email or password. Please check your credentials.'])->withInput();
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_user', 'admin_email', 'admin_role']);
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}