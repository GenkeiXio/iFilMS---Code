<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // List users
    public function index(Request $request)
    {
        $query = Staff::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('username', 'like', '%' . $request->search . '%');
            });
        }

        // Role filter
        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        // Status filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Rows per page
        $perPage = $request->get('per_page', 10);

        // Paginated users
        $users = $query
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        // STATS (from staff table)
        $totalUsers    = Staff::count();
        $activeUsers   = Staff::where('status', 'active')->count();
        $inactiveUsers = Staff::where('status', 'inactive')->count();
        $adminUsers    = Staff::where('role', 'admin')->count();

        return view('admin.users', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'adminUsers'
        ));
    }

    // Create user
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:staff,username',
            'name'     => 'required',
            'password' => 'required|min:8',
            'role'     => 'required|in:admin,staff',
        ]);

        $permissions = [
            'upload'   => $request->has('permissions.upload'),
            'download' => $request->has('permissions.download'),
            'view'     => $request->has('permissions.view'),
            'delete'   => $request->has('permissions.delete'),
        ];

        if ($request->role === 'admin') {
            $permissions = ['upload'=>true,'download'=>true,'view'=>true,'delete'=>true];
        }

        Staff::create([
            'username'    => $request->username,
            'name'        => $request->name,
            'password'    => Hash::make($request->password),
            'role'        => $request->role,
            'status'      => 'active',
            'permissions' => $permissions,
        ]);

        return back()->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        // Prevent self-edit
        if (Auth::guard('staff')->id() == $id) {
            abort(403, 'You cannot edit your own account.');
        }

        return response()->json(Staff::findOrFail($id));
    }

    // Update user
    public function update(Request $request, $id)
    {
        // Prevent self-edit
        if (Auth::guard('staff')->id() == $id) {
            return back()->with('error', 'You cannot edit your own account.');
        }

        $user = Staff::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:staff,username,' . $id . ',staff_id',
            'name'     => 'required',
            'role'     => 'required|in:admin,staff',
        ]);

        $permissions = [
            'upload'   => $request->has('permissions.upload'),
            'download' => $request->has('permissions.download'),
            'view'     => $request->has('permissions.view'),
            'delete'   => $request->has('permissions.delete'),
        ];

        if ($request->role === 'admin') {
            $permissions = ['upload'=>true,'download'=>true,'view'=>true,'delete'=>true];
        }

        $data = [
            'name'        => $request->name,
            'username'    => $request->username,
            'role'        => $request->role,
            'permissions' => $permissions,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'User updated.');
    }

    // Activate / Deactivate
    public function toggleStatus($id)
    {
        $user = Staff::findOrFail($id);

        // Prevent self-deactivation
        if (Auth::guard('staff')->id() == $user->staff_id) {
            return back()->with('error', 'You cannot deactivate your own account.');
        }

        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return back()->with('success', 'User status updated.');
    }

    public function resetPassword($id)
    {
        $password = str()->random(10);

        Staff::findOrFail($id)->update([
            'password' => Hash::make($password)
        ]);

        return back()->with('success', "New password: {$password}");
    }
}
