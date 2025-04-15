<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class UserController extends Controller
{
    public function index()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $users = User::paginate(10);
        return view('admin.users.index', compact('users', 'layout'));
    }

    public function edit(User $user)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        return view('admin.users.edit', compact('user', 'layout'));
    }

    public function update(Request $request, User $user)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.users.edit', ['user' => $user->id])
            ->with([
                'layout' => $layout,
                'success' => 'ユーザー情報を更新しました。'
            ]);
    }

    public function destroy(User $user)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with([
                'layout' => $layout,
                'success' => 'ユーザーを削除しました'
            ]);
    }
}



