<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Dosen;
use App\Kelas;
use DataTables;
use App\Jurusan;
use App\Kelompok;
use App\Pengumuman;
use App\TahunAjaran as TA;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        return view("koordb");
    }

    public function dataKelompok()
    {   
        $smt = TA::where("isActive",1)->first();
        $kelas = Kelas::where("id_user",Auth::user()->id)->where("id_tahunajaran",$smt->id)->get();
        return view('dataKelompok',compact("kelas"));
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

    public function editKelompok(Request $req)
    {
        $validatedData = $req->validate([
            'id' => 'required',
        ]);

       
        $inp = Kelompok::find($req->id);
        $inp->stand = $req->stand;
        $inp->nilai = $req->nilai;
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

    public function getKelDetail($id)
    {
        $kel = Kelompok::with("dosen","proposal")->where("id",$id)->first();
        $kel->anggota = $kel->mhs()->select("nomor","nama")->get();
        if(!is_null($kel->proposal)){
            $kel->history = $kel->proposal->history()->get();
        }
        return $this->setResponse($kel);
    }

    public function getTaughClass($id)
    {
        $jur = Kelompok::where("id_kelas",$id)->get();

        return DataTables::of($jur)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
   
                                $btn = '<a onclick="editDt('.$row->id.')" class="edit btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>';
                                $btn .= '&emsp;<a onclick="viewDt('.$row->id.')" class="edit btn btn-info btn-sm"><i class="fa fa-eye"></i> Detail</a>';
                                // $btn .= '&emsp;<a onclick="deleteDt('.$row->id.')" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
          
                                 return $btn;
                            })
                            ->addColumn('dosen_name', function($row){
                                 return $row->dosen->nama;
                            })
                            ->addColumn('judul_prop', function($row){
                                return empty($row->id_proposal)? "" : $row->proposal->judul;
                            })
                            ->rawColumns(['action',"isi_html"])
                            ->make(true);
    }
}
