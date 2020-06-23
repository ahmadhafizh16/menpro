<?php

namespace App\Http\Controllers;

use DB;
use App\Dosen;
use App\Kelas;
use App\User;
use DataTables;
use App\Jurusan;
use App\TahunAjaran as TA;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addJurusan(Request $req)
    {
        $validatedData = $req->validate([
            'nama' => 'required',
            'semester_aktif' => 'required',
        ]);

        $j = new Jurusan();
        $j->nama = $req->nama;
        $j->semester_aktif = $req->semester_aktif;
        $j->save();

        return $this->setResponse($j);
    }

    public function editJurusan(Request $req)
    {
        $validatedData = $req->validate([
            'id' => 'required',
            'nama' => 'required',
            'semester_aktif' => 'required',
        ]);
        // dd($req->all());
        $j = Jurusan::find($req->id);
        $j->nama = $req->nama;
        $j->semester_aktif = $req->semester_aktif;
        $j->save();

        return $this->setResponse($j);
    }

    public function deleteJurusan(Request $req)
    {
        $validatedData = $req->validate([
            'id' => 'required'
        ]);
        // dd($req->all());
        $j = Jurusan::find($req->id);
        $j->delete();

        return $this->setResponse($j);
    }

    public function jurusanData()
    {
        $jur = Jurusan::all();

        return DataTables::of($jur)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
   
                                $btn = '<a onclick="editDt('.$row->id.')" class="edit btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>';
                                $btn .= '&emsp;<a onclick="deleteDt('.$row->id.')" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
          
                                 return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
    }

    #
    #
    # TAHUN AJARAN
    #
    #

    public function addTAjaran(Request $req)
    {
        $validatedData = $req->validate([
            'tahun' => 'required',
            'semester' => 'required',
            'isActive' => 'required',
        ]);

        if(TA::where("tahun",$req->tahun)->where("semester",$req->semester)->exists()){
            return $this->setResponse(["error" => ["Data sudah pernah ditambahkan !"]],400);
        }
        

        if($req->isActive == 1){
            DB::table("tahun_ajaran")->update(["isActive" => 0]);
        }

        $inp = new TA();
        $inp->tahun = $req->tahun;
        $inp->semester = $req->semester;
        $inp->isActive = $req->isActive;
        $inp->save();

        return $this->setResponse($inp);
    }

    public function editTAjaran(Request $req)
    {
        $validatedData = $req->validate([
            'id' => 'required',
        ]);
        // dd($req->all());
        DB::table("tahun_ajaran")->update(["isActive" => 0]);

        $inp = TA::find($req->id);
        $inp->isActive = 1;
        $inp->save();

        return $this->setResponse($inp);
    }

    public function deleteTAjaran(Request $req)
    {
        $validatedData = $req->validate([
            'id' => 'required'
        ]);
        // dd($req->all());
        $j = TA::find($req->id);
        $j->delete();

        return $this->setResponse($j);
    }

    public function tajaranData()
    {
        $jur = TA::orderBy("isActive","desc")->get();

        return DataTables::of($jur)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $btn = "";

                                if($row->isActive == 0){
                                    $btn = '<a onclick="editDt('.$row->id.')" class="edit btn btn-info btn-sm"><i class="fa fa-check"></i> Set Aktif</a>';
                                }
                                else{
                                    $btn = '<button class="edit btn btn-default btn-sm" disabled><i class="fa fa-check"></i> Set Aktif</button>';
                                }

                                $btn .= '&emsp;<a onclick="deleteDt('.$row->id.')" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
          
                                 return $btn;
                            })
                            ->addColumn('isActIco', function($row){
                                if($row->isActive == 1){
                                    $btn = '<span class="label label-success"><i class="fa fa-check"></i> Aktif </span>';
                                }
                                else{
                                    $btn = '<span class="label label-warning"> <i class="fa fa-times"></i> Tidak Aktif </span>';
                                }
          
                                 return $btn;
                            })
                            ->rawColumns(['action','isActIco'])
                            ->make(true);
    }

    /**
     * 
     *  KELAS
     * 
     */

    public function addKelas(Request $req)
    {
        $validatedData = $req->validate([
            'tahun' => 'required',
            'jurusan' => 'required',
            'dosen' => 'required',
            'kelas' => 'required',
        ]);

        if(Kelas::where("kelas",$req->kelas)->where("id_jurusan",$req->jurusan)->where("id_tahunajaran",$req->tahun)->exists()){
            return $this->setResponse(["error" => ["Data sudah pernah ditambahkan !"]],400);
        }

        $inp = new Kelas();
        $inp->id_jurusan = $req->jurusan;
        $inp->id_dosen = $req->dosen;
        $inp->id_tahunajaran = $req->tahun;
        $inp->kelas = $req->kelas;
        $inp->save();

        return $this->setResponse($inp);
    }

    public function editKelas(Request $req)
    {
        $validatedData = $req->validate([
            'id' => 'required',
            'tahun' => 'required',
            'jurusan' => 'required',
            'dosen' => 'required',
            'kelas' => 'required',
        ]);

        if(Kelas::where("kelas",$req->kelas)->where("id_jurusan",$req->jurusan)->where("id_tahunajaran",$req->tahun)->exists()){
            return $this->setResponse(["error" => ["Data sudah pernah ditambahkan !"]],400);
        }

        $inp = Kelas::find($req->id);
        $inp->id_jurusan = $req->jurusan;
        $inp->id_dosen = $req->dosen;
        $inp->id_tahunajaran = $req->tahun;
        $inp->kelas = $req->kelas;
        $inp->save();

        return $this->setResponse($inp);
    }

    public function deleteKelas(Request $req)
    {
        $validatedData = $req->validate([
            'id' => 'required'
        ]);
        // dd($req->all());
        $j = Kelas::find($req->id);
        $j->delete();

        return $this->setResponse($j);
    }

    public function kelasData()
    {
        $ta = TA::where("isActive",1)->first();

        $jur = Kelas::orderBy("id_jurusan","desc")->orderBy("kelas","asc")->get();

        return DataTables::of($jur)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){

                                $btn = '<a onclick="editDt('.$row->id.')" class="edit btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>';

                                $btn .= '&emsp;<a onclick="deleteDt('.$row->id.')" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
          
                                 return $btn;
                            })
                            ->addColumn('dosen_name', function($row){
                                return $row->dosen->nama;
                            })
                            ->addColumn('tahunAj', function($row){
                                return $row->tahun->tahun." - ".$row->tahun->semester_act;
                            })
                            ->addColumn('jurusan_name', function($row){
                                return $row->jurusan->nama;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
    }
    
    /**
     * 
     *  DATA PROVIDER
     * 
     */

    public function getJurusanActive()
    {
        $ta = TA::where("isActive",1)->first();

        $jur = Jurusan::select("id","nama as text")->where("semester_aktif",$ta->semester)->get();

        return $this->setResponse($jur);
    }

    public function getDosen()
    {
        // $ta = TA::where("isActive",1)->first();

        $jur = Dosen::where("nama","!=","admin")->get();

        foreach($jur as &$j){
            $j->text = "[$j->nid] $j->nama";
        }

        return $this->setResponse($jur);
    }

    public function getKelas()
    {
        $jur = substr(auth()->guard("web")->user()->nim,0,2);

        $ta = TA::where("isActive",1)->first();

        $kelas = Kelas::where("id_tahunajaran",$ta->id)->where("id_jurusan",$jur)->orderBy("id_jurusan","desc")->orderBy("kelas","asc")->get();

        foreach($kelas as &$j){
            $j->text = $j->jurusan->nama." [$j->kelas]";
        }

        return $this->setResponse($kelas);
    }

    public function getMhs()
    {
        $jur = substr(auth()->guard("web")->user()->nim,0,2);

        $ta = TA::where("isActive",1)->first();

        $mhs = User::where("nim","like","$jur%")->orderBy("nim","desc")->get();

        foreach($mhs as &$j){
            $j->text = $j->nama." [$j->nim]";
        }

        return $this->setResponse($mhs);
    }


  
}
