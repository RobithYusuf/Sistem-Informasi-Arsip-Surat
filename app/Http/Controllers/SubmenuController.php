<?php

namespace App\Http\Controllers;

use App\Models\UserMenu;
use App\Models\UserSubmenu;
use Illuminate\Http\Request;

class SubmenuController extends Controller
{
    public function index()
    {
        $subMenus = UserSubmenu::all();
        return view('admin.sub_menu.index', compact('subMenus'));
    }


    public function create()
    {
        $menus = UserMenu::all();
        return view('admin.sub_menu.create', compact('menus'));
    }

    public function store(Request $request)
    {
        UserSubmenu::create($request->all());
        return redirect()->route('admin.sub_menu.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(UserSubmenu $subMenu)
    {
        return view('admin.sub_menu.edit', compact('subMenu'));
    }

    public function update(Request $request, UserSubmenu $subMenu)
    {
        $subMenu->update($request->all());
        return redirect()->route('admin.sub_menu.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(UserSubmenu $subMenu)
    {
        $subMenu->delete();
        return redirect()->route('admin.sub_menu.index')->with('success', 'Data berhasil dihapus!');
    }
}
