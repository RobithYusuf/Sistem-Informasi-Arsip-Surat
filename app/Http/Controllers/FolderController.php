<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{

    public function index()
    {
        $folders = Folder::all();
        return view('admin.folder.index', compact('folders'));
    }

    public function create()
    {
        return view('admin.folder.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'folder' => 'required',
        ]);

        Folder::create($request->all());
        return redirect()->route(getCurrentRoutePrefix() . '.data-folder.index')->with('success', 'Folder berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $folder = Folder::find($id);
        return view('admin.folder.show', compact('folder'));
    }

    public function edit(Folder $data_folder)
    {
        return view('admin.folder.edit', compact('data_folder'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'folder' => 'required',
        ]);

        $folder = Folder::find($id);
        $folder->update($request->all());

        return redirect()->route(getCurrentRoutePrefix() . '.data-folder.index')->with('success', 'Folder berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $folder = Folder::find($id);
        $folder->delete();

        return redirect()->route(getCurrentRoutePrefix() . '.data-folder.index')->with('success', 'Folder berhasil dihapus');
    }
}
