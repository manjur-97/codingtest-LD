<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('dashboard');
    }

    // Fetch users for DataTables
    public function getUsers()
    {
        $users = User::select(['id', 'name', 'email', 'created_at']);
        return DataTables::of($users)
            ->addColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d-m-Y');
            })
            ->addColumn('action', function ($user) {
                return '<button class="btn btn-primary btn-sm editUser" data-id="' . $user->id . '">Edit</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // Get single user data
    public function getUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Update user data via AJAX
    public function updateUser(UpdateUserRequest $request)
    {
        try {
            $user = User::find($request->id);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            return response()->json(['success' => 'User updated successfully']);
        } catch (\Exception $e) {

            \Log::error('User update failed: ' . $e->getMessage(), [
                'id' => $request->id,
                'input' => $request->all(),
            ]);

            return response()->json([
                'error' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
