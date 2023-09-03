<?php

namespace App\Http\Controllers;

use App\Models\UserMenu;
use Illuminate\Http\Request;

class UserMenuController extends Controller
{

    public function index()
    {
        $menus = UserMenu::all();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        UserMenu::create($request->all());
        return redirect()->route(getCurrentRoutePrefix() . '.menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(UserMenu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, UserMenu $menu)
    {


        $validatedData = $request->validate([
            'menu' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'url' => 'required|string|max:255',

        ]);

        $menu->update($validatedData);
        return redirect()->route(getCurrentRoutePrefix() . '.menu.index')->with('success', 'Data berhasil diperbarui!');
    }


    public function destroy(UserMenu $menu)
    {
        $menu->delete();
        return redirect()->route(getCurrentRoutePrefix() . '.menu.index')->with('success', 'Data berhasil dihapus!');
    }
}
