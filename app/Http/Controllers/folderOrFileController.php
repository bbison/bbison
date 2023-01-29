<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\folderOrFile;
use Illuminate\Support\Facades\File; 

class folderOrFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('folderOrFile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $geturl =url()->previous();
        $explode = explode('/', $geturl);
        $count = count($explode);
        $getindex = $count - 2 ;
        $perents = $explode[$getindex];
        
        $perent = str_replace('%20','-', $perents); 

        //role admin
        $create = folderOrFile::create([
            'role_id'=>auth()->user()->role->id,
            'user_id'=>auth()->user()->id,
            'perent'=>$perent,
            'name'=>$request['name'],
            'type'=>$request['type'],
        ]);
        if($create){
        return back()->with('pesan', 'Berhasil Menambahkan Folder');
        }
        else{
            return "gagal";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($str)
    {
        return view('ajax',[
            'folders'=>folderOrFile::where('name','like', '%'.$str.'%')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteFile($id)
    {
        $folder=FolderOrFile::find($id);
        if(file::exists(public_path('app/file/'.$folder->path)))
        {
            FIle::delete(public_path('app/file/'.$folder->path));
            $folder->delete();
            return back();
        }
        $folder->delete();
        return back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $geturl =url()->previous();
        $explode = explode('/', $geturl);
        $count = count($explode);
        $getindex = $count - 2 ;
        $perents = $explode[$getindex];
        
        $perent = str_replace('%20','-', $perents); 

        //role admin
        if($request->file('foto')){
            $create = folderOrFile::find($id)->update([
                'logo'=>$request->file('foto')->store('')
            ]);
            if($create){
            return back()->with('pesan', 'Berhasil Menambahkan Folder');
            }
            else{
                return "gagal";
            }
        }

        folderOrFile::find($id)->update([
            'name'=>$request['name']
        ]);
        return back();
     
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $folder=FolderOrFile::find($id);
        if(file::exists(public_path('app/file/'.$folder->logo)))
        {
            FIle::delete(public_path('app/file/'.$folder->logo));
            $folder->delete();
            return back();
        }
        $folder->delete();
        return back();
    }
    
    public function folder($hakakses, $folder)
    {
        $uHAkses = ucwords($hakakses);
        $search=str_replace(' ','-', $folder);
        return view('administrasiGuru.index',[
            'folders'=>folderOrFile::where('type','folder')
            ->where('perent', $search)->get(),
            'files'=>folderOrFile::where('type','file')
            ->where('perent', $search)->get(),
            'akses'=>$uHAkses
        ]);
    }

    public function uploadFile(Request $request)
    {
        $geturl =url()->previous();
        $explode = explode('/', $geturl);
        $perents = end($explode);
        $perent = str_replace('%20','-', $perents); 

        if($request->file('name')->extension()=='txt'){
            $logo = 'https://cdn-icons-png.flaticon.com/512/28/28878.png';
        }
        elseif($request->file('name')->extension()=='docx'){
            $logo = 'https://cdn-icons-png.flaticon.com/512/28/28863.png';
        }
        elseif($request->file('name')->extension()=='pdf'){
            $logo = 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/833px-PDF_file_icon.svg.png';
        }
        elseif($request->file('name')->extension()=='jpg'){
            $logo = '';
        }
        elseif($request->file('name')->extension()=='png'){
            $logo = '';
        }
        elseif($request->file('name')->extension()=='xlsx'){
            $logo = 'https://upload.wikimedia.org/wikipedia/commons/7/73/Microsoft_Excel_2013-2019_logo.svg';
        }

        
        $geturl =url()->previous();
        $explode = explode('/', $geturl);
        $count = count($explode);
        $getindex = $count - 2 ;
        $perents = $explode[$getindex];
        
        $perent = str_replace('%20','-', $perents); 

        $create = folderOrFile::create([
            'role_id'=>auth()->user()->role->name,
            'logo'=>$logo,
            'user_id'=>auth()->user()->id,
            'ekstensi'=>$request->file('name')->extension(),
            'perent'=>$perent,
            'name'=>$request->file('name')->getClientOriginalName(),
            'type'=>$request['type'],
            'size'=>$request->file('name')->getSize().' '.'kb',
            'path'=>$request->file('name')->store('')
        ]);
        if($create){
        return back()->with('pesan', 'Berhasil Upload File');
        }
        else{
            return "gagal";
        }
    }
    
    public function download($path,$name)
    {
        return response()->download(public_path('app/file/'.$path), $name);
    }
    public function view($path,$name)
    {
        return view('view', [
            'path'=>$path,
            'name'=>$name
        ]);
    }

}
