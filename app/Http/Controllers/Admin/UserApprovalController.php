<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserApprovalController extends Controller
{
    /**
     * Display a listing of users pending approval.
     */
    public function index(): View
    {
        $users = User::where('is_approved', false)
            ->where('role', 'siswa')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Approve a user so they can login.
     */
    public function approve(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diaktifkan.');
    }
}
