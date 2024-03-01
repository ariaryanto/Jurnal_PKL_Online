<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Database\Eloquent\Builder;
use PDF;
use App\Jobs\ProcessCSVData;
use Illuminate\Support\Facades\Bus;
use Illuminate\Contracts\Pagination\Paginator;


class AdminController extends Controller
{
    public function index(Request $request, User $user){
    $users = User::query()
    ->when($request->q, function (Builder $builder) use ($request) {
        $builder->where('name', 'like', "%{$request->q}%")
        ->orWhere('email', 'like', "%{$request->q}%");
        })->simplePaginate(5);

    return view('admin.index', compact('users'));
}

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.tambah-user');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'required',
            'role_id'       => 'required',
            'tempat_pkl'    => 'required'

        ]);

        //create user
        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'role_id'       => $request->role_id,
            'tempat_pkl'    => $request->tempat_pkl

        ]);

        //redirect to index
        return redirect('/admin/beranda')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit
     *
     * @param  mixed $users
     * @return void
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.edit',[
            'user' => $user,
        ]);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $users
     * @return void
     */
    public function update(Request $request, $id)
    {
        //validate form
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'required',
            'role_id'       => 'required',
            'tempat_pkl'    => 'required'

        ]);

        //update user
        User::where('id', $id)->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'role_id'       => $request->role_id,
            'tempat_pkl'    => $request->tempat_pkl

        ]);

        //redirect to index
        return redirect('/admin/beranda')->with(['update' => 'Data Berhasil Diubah!']);
    }

    public function show(Request $request, $id) 
    {
            $kegiatans = Kegiatan::query()
            ->when($request->q, function (Builder $builder) use ($request) {
            $builder->where('tanggal', 'like', "%{$request->q}%")
            ->orWhere('waktu', 'like', "%{$request->q}%");
            })->where('user_id', $id)->latest()->simplePaginate(5);
    
        return view('admin.show', compact('kegiatans'));
    }
    
    
    // { 
        
    //     //get users
    //     $kegiatans = Kegiatan::where('id', $id)->latest()->paginate(5);

    //     //render view with users
    //     return view('admin.show', compact('kegiatans'));
        
    // }
        

    public function destroy($id)

    {
        User::where('id', $id)->first()->delete();
        return back()->with('delete','Data Berhasil Di Hapus!');    
    }

    public function sedit($id) { 
        $kegiatan = Kegiatan::where('id', $id)->first();
        return view('admin.sedit',[
            'kegiatan' => $kegiatan,
        ]);
    }

    public function supdate(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal'   => 'required',
            'waktu'     => 'required',
            'kegiatan'  => 'required',
        ]);

        Kegiatan::where('id', $id)->update([
            'tanggal'   => $request->tanggal,
            'waktu'     => $request->waktu,
            'kegiatan'  => $request->kegiatan,

        ]);
        return Redirect::route('admin.show', array('id' =>$id))->with('update','Data Berhasil Di Diubah!');
    }

    public function sdestroy($id)

    {
        Kegiatan::where('id', $id)->first()->delete();
        return back()->with('delete','Data Berhasil Di Hapus!');    
    }

    public function pdf(Request $request, $id)
	{
        $printkegiatans = Kegiatan::where('user_id', $id)->latest()->simplePaginate(5);
        return view('admin.pdf', compact('printkegiatans'));
	}
}