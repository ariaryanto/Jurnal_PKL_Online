<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use PDF;

class UserController extends Controller
{
    public function index(Request $request){
        $kegiatans = Kegiatan::query()
        ->when($request->q, function (Builder $builder) use ($request) {
            $builder->where('tanggal', 'like', "%{$request->q}%")
            ->orWhere('waktu', 'like', "%{$request->q}%");
            })->where('user_id', Auth::user()->id)->latest()->simplePaginate(6);
     
        return view('user.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('user.kegiatan');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'   => 'required',
            'waktu'     => 'required',
            'kegiatan'  => 'required',
        ]);

        $userid = Auth::user()->id;
        $username = Auth::user()->name;

        Kegiatan::create([
            'tanggal'   => $request->tanggal,
            'name'      => $username,
            'waktu'     => $request->waktu,
            'kegiatan'  => $request->kegiatan,
            'user_id'   => $userid
        ]);
        return redirect('/user/beranda')->with('succes','Data Berhasil Di Simpan!');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::where('id', $id)->first();
        return view('user.edit',[
            'kegiatan' => $kegiatan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal'   => 'required',
            'waktu'     => 'required',
            'kegiatan'  => 'required',
        ]);

        $userid = Auth::user()->id;
        $username = Auth::user()->name;

        Kegiatan::where('id', $id)->update([
            'tanggal'   => $request->tanggal,
            'name'      => $username,
            'waktu'     => $request->waktu,
            'kegiatan'  => $request->kegiatan,
            'user_id'   => $userid

        ]);
        return redirect('/user/beranda')->with('update','Data Berhasil Di Diubah!');
    }

    public function destroy($id)

    {
        Kegiatan::where('id', $id)->first()->delete();
        return back()->with('delete','Data Berhasil Di Hapus!');    
    }

    public function pdf(Request $request)
	{
        $printkegiatans = Kegiatan::where('user_id', Auth::user()->id)->latest()->simplePaginate(5);
        return view('user.pdf', compact('printkegiatans'));
	}
}