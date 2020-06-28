<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Dosen;
use App\Kelas;
use DataTables;
use App\Jurusan;
use App\Pengumuman;
use App\TahunAjaran as TA;
use Illuminate\Http\Request;

class KoorController extends Controller
{
    public function index()
    {
        return view("koordb");
    }

    public function createPengumuman()
    { 
        return view('createPengumuman');
    } 

    public function addPengumuman(Request $req)
    {
        $validatedData = $req->validate([
            'isi' => 'required',
            'judul' => 'required',
        ]);
        $fName = "blog/img/itens.jpg";
        if($req->hasFile("file")){
            $fName = time().'_'.$req->file->getClientOriginalName();
            $req->file->move(public_path('upload'), $fName);
            $fName = "upload/".$fName;
        }

        $inp = new Pengumuman();
        $inp->thumbnail = $fName;
        $inp->isi = $req->isi;
        $inp->judul = $req->judul;
        $inp->id_user = Auth::user()->id;
        $inp->save();

        return $this->setResponse($inp);
    }

    public function editPengumuman(Request $req)
    {
        $validatedData = $req->validate([
            'id' => 'required',
            'isi' => 'required',
            'judul' => 'required',
        ]);
        $fName = "blog/img/itens.jpg";
        $inp = Pengumuman::find($req->id);

        if($req->hasFile("file")){
            $fName = time().'_'.$req->file->getClientOriginalName();
            $req->file->move(public_path('upload'), $fName);
            $fName = "upload/".$fName;
            $inp->thumbnail = $fName;
        }

        $inp->isi = $req->isi;
        $inp->judul = $req->judul;
        $inp->id_user = Auth::user()->id;
        $inp->save();

        return $this->setResponse($inp);
    }

    public function deletePengumuman(Request $req)
    {
        $validatedData = $req->validate([
            'id' => 'required'
        ]);
        // dd($req->all());
        $j = Pengumuman::find($req->id);
        $j->delete();

        return $this->setResponse($j);
    }

    public function getPengumuman()
    {
        $jur = Pengumuman::all();

        return DataTables::of($jur)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
   
                                $btn = '<a onclick="editDt('.$row->id.')" class="edit btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>';
                                $btn .= '&emsp;<a onclick="viewDt('.$row->id.')" class="edit btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>';
                                $btn .= '&emsp;<a onclick="deleteDt('.$row->id.')" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
          
                                 return $btn;
                            })
                            ->addColumn('isi_html', function($row){
                                 return $row->isi;
                            })
                            ->addColumn('dosen_name', function($row){
                                 return $row->dosen->nama;
                            })
                            ->rawColumns(['action',"isi_html"])
                            ->make(true);
    }
}
