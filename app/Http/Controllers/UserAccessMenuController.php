<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\UserMenu;
use App\Models\UserSubmenu;
use Illuminate\Http\Request;
use App\Models\UserAccessMenu;

class UserAccessMenuController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        $menus = UserMenu::all();
        $subMenus = UserSubmenu::all();
        $accessMenus = UserAccessMenu::all();
        return view('admin.access_menu.index', compact('roles', 'menus', 'subMenus', 'accessMenus'));
    }

    public function create()
    {
        $roles = Role::all();
        $menus = UserMenu::all();
        return view('admin.access_menu.create', compact('roles', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:role,id_role',
            'menu_id' => 'required|exists:user_menu,id_user_menu',
        ]);

        UserAccessMenu::create([
            'role_id' => $request->role_id,
            'menu_id' => $request->menu_id,
        ]);

        return redirect()->route(getCurrentRoutePrefix() . '.access_menu.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(UserAccessMenu $access_menu)
    {

        $submenu = UserSubmenu::all();
        return view('admin.access_menu.edit', compact('access_menu', 'submenu'));
    }


    public function update(Request $request, UserAccessMenu $access_menu)


    {

        // Update UserMenu
        $menu = UserMenu::find($request->menu_id);
        if ($menu) {
            $menu->update([
                'menu' => $request->menu,
            ]);
        }

        // Update UserSubmenu
        if (isset($request->submenus)) {
            foreach ($request->submenus as $id => $submenuData) {
                $submenu = UserSubmenu::find($id);
                if ($submenu) {
                    $submenu->update([
                        'nama_submenu' => $submenuData['nama_submenu'],
                        'url' => $submenuData['url'],
                        'icon' => $submenuData['icon'],
                        'is_active' => isset($submenuData['is_active']) ? 1 : 0,

                    ]);
                }
            }
        }

        return redirect()->route(getCurrentRoutePrefix() . '.access_menu.index')->with('success', 'Data berhasil diperbarui!');
    }



    public function destroy(UserAccessMenu $accessMenu)
    {
        $accessMenu->delete();
        return redirect()->route(getCurrentRoutePrefix() . '.access_menu.index')->with('success', 'Data berhasil dihapus!');
    }
}
