<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Kelompok;
use App\User;
use App\Proposal;
use App\Pengumuman;
use App\ProposalHistory;
use App\TahunAjaran as TA;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth.admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(Auth::user()->role == 4) return redirect("/regis");
        return view('home');
    }
    
    public function lpHome(){
        $peng = Pengumuman::orderBy("created_at","desc")->get();
        $prop1 = Proposal::whereIn('id',function($query) {
                                        $query->select('id_proposal')->from('proposal_history');
                                    })
                                    ->where("banner","!=","null")->orderBy("id","desc")->limit(2)->get();
        $prop2 = Proposal::whereIn('id',function($query) {
                                        $query->select('id_proposal')->from('proposal_history');
                                    })
                                    ->where("banner","!=","null")->orderBy("id","desc")->offset(2)->limit(2)->get();
        
        return view('lpHome',compact("peng","prop1","prop2"));
    }

    public function news($id)
    {
        $pen = Pengumuman::findOrFail($id);
        return view('lpNews',compact("pen"));
    }

    public function jurusan()
    {
        return view('jurusan');
    }

    public function proposal($jur = 0,$jenis = 0,$bidang = 0,$search = null)
    {   
        $prop2 = Proposal::whereIn('id',function($query) {
            $query->select('id_proposal')->from('proposal_history');
        })
        ->where("banner","!=","null");

        if($jenis){
            $prop2 = $prop2->where("jenis",$jenis);
        }
        
        if($bidang){
            // dd($bidang);
            $prop2 = $prop2->where("bidang",$bidang);
        }

        if($search){
            $prop2 = $prop2->where("judul","like","%$search%");
        }

        $prop2 = $prop2->orderBy("id","desc")->paginate(10);
        // dd($jenis);
        return view('lpProp',compact("prop2","jenis","bidang","search"));
    }

    public function getIn(){
        // dd($user);
        switch (Auth::user()->role){
          case '1':
                return redirect("/home");
          case '2':
                return redirect("/koordb");
          case '3':
                return redirect("/dosendb");
          case '4':
                return redirect("/regis");
        }
      }

    public function setDosen()
    {
        return view('setDosen');
    }
    
    public function setKelas()
    {
        $ta = TA::where("isActive",1)->first();
        if(is_null($ta)){
            return "<script>alert('Mohon input tahun ajaran terlebih dahulu'); window.location = '".url("/tahunajaran")."'</script>";
        }
        return view('kelas',compact("ta"));
    }

    public function tahunAjaran()
    {
        return view('tahunajaran');
    }

    public function uplProposal()
    {
        $mhs =auth()->guard("web")->user()->id;
        $dtKel = DB::table("detail_kelompok")->where("id_user",$mhs);
        $isAda = $dtKel->exists();
        if($isAda){
            $dtKel = $dtKel->first();
            $kelompok = Kelompok::find($dtKel->id_kelompok);
            $isUploaded = ProposalHistory::where("id_proposal",$kelompok->id_proposal)->get();
            // dd($kelompok->mhs()->get());
        }
        // dd($isUploaded->isEmpty());
        return view('uplProposal',compact("isAda","kelompok","isUploaded"));
    }

    public function uplBanner()
    {
        $mhs =auth()->guard("web")->user()->id;
        $dtKel = DB::table("detail_kelompok")->where("id_user",$mhs);
        
        $dtKel = $dtKel->first();
        $kelompok = Kelompok::find($dtKel->id_kelompok);
        $prop = Proposal::find($kelompok->id_proposal);

        
        return view('uplBanner',compact("prop"));
    }

    public function dataKelompok()
    {
        return view('dataKelompok');
    }

    public function dataProposal()
    {
        return view('dataProposal');
    }

    public function regisMhs()
    {   
        $mhs = auth()->guard("web")->user()->id;
        $dtKel = DB::table("detail_kelompok")->where("id_user",$mhs);
        $isAda = $dtKel->exists();
        // dd($isAda);
        
        $isUploaded = ProposalHistory::where("id_proposal","0")->get();
        if($isAda){
            $dtKel = $dtKel->first();
            $kelompok = Kelompok::find($dtKel->id_kelompok);
            // dd($kelompok->mhs()->get());
            if(!empty($kelompok->id_proposal)){
                $isUploaded = ProposalHistory::where("id_proposal",$kelompok->id_proposal)->get();
            }
        }
        // dd($isUploaded[0]);
        
        return view('regismahasiswa',compact("isAda","kelompok","isUploaded"));
    }

    public function addKelompok(Request $req)
    {
        $validatedData = $req->validate([
            'dosen' => 'required',
            'nama_kel' => 'required',
            'kel' => 'required|min:2',
            'kelas' => 'required',
        ],["min" => "Pilih 2 anggota kelompok"]);
        // dd($req->all());
        // if(Kelas::where("kelas",$req->kelas)->where("id_jurusan",$req->jurusan)->where("id_tahunajaran",$req->tahun)->exists()){
        //     return $this->setResponse(["error" => ["Data sudah pernah ditambahkan !"]],400);
        // }
        $kel = $req->kel;
        array_push($kel,Auth::user()->id);
        $inp = new Kelompok();
        $inp->id_dosbing = $req->dosen;
        $inp->id_kelas = $req->kelas;
        $inp->nama_kel = $req->nama_kel;
        $inp->save();

        $inp->mhs()->attach($kel);
        
        return $this->setResponse($inp);
    }

    public function addProposal(Request $req)
    {
        $validatedData = $req->validate([
            'judul' => 'required',
            'jenis' => 'required',
            'bidang' => 'required',
            'deskripsi' => 'required',
        ]);
        // dd($req->all());
        // if(Kelas::where("kelas",$req->kelas)->where("id_jurusan",$req->jurusan)->where("id_tahunajaran",$req->tahun)->exists()){
        //     return $this->setResponse(["error" => ["Data sudah pernah ditambahkan !"]],400);
        // }
        $mhs = auth()->guard("web")->user()->id;
        $dtKel = DB::table("detail_kelompok")->where("id_user",$mhs)->first();
        $kelompok = Kelompok::find($dtKel->id_kelompok);

        $inp = new Proposal();
        $inp->judul = $req->judul;
        $inp->jenis = $req->jenis;
        $inp->bidang = $req->bidang;
        $inp->deskripsi = $req->deskripsi;
        $inp->save();

        $kelompok->id_proposal = $inp->id;
        $kelompok->save();

        return $this->setResponse($inp);
    }

    public function editProposal(Request $req)
    {
        $validatedData = $req->validate([
            'id' => 'required',
            'judul' => 'required',
            'jenis' => 'required',
            'bidang' => 'required',
            'deskripsi' => 'required',
        ]);

        $inp = Proposal::find($req->id);
        $inp->judul = $req->judul;
        $inp->jenis = $req->jenis;
        $inp->bidang = $req->bidang;
        $inp->deskripsi = $req->deskripsi;
        $inp->save();

        return $this->setResponse($inp);
    }

    public function uploadProp(Request $req)
    {   
        $validatedData = $req->validate([
            // 'id' => 'required',
            'judulFile' => 'required',
            'keterangan' => 'required',
            'file' => 'required|mimes:doc,pdf,docx|max:10240',
        ]);
        
        $mhs =auth()->guard("web")->user()->id;
        $dtKel = DB::table("detail_kelompok")->where("id_user",$mhs);

        $dtKel = $dtKel->first();
        $kelompok = Kelompok::find($dtKel->id_kelompok);
            
        $fName = time().'_'.$req->file->getClientOriginalName();
        $req->file->move(public_path('upload'), $fName);
        
        $inp = new ProposalHistory();
        $inp->judul_file = $req->judulFile;
        $inp->keterangan = $req->keterangan;
        $inp->id_proposal = $kelompok->id_proposal;
        $inp->file_proposal = "upload/".$fName;
        $inp->save();

        return $this->setResponse($inp);
    }

    public function uploadBanner(Request $req)
    {   
        $validatedData = $req->validate([
            'id' => 'required',
            'file' => 'required|mimes:png,jpg,jpeg|max:10240',
        ]);
        
      
        $inp = Proposal::find($req->id);
            
        $fName = time().'_'.$req->file->getClientOriginalName();
        $req->file->move(public_path('upload'), $fName);
        if(!empty($inp->banner)){
            unlink(public_path("/").$inp->banner);
        }
        $inp->banner = "upload/".$fName;
        $inp->save();

        return $this->setResponse($inp);
    }

    public function deleteProp(Request $req)
    {   
        $validatedData = $req->validate([
            // 'id' => 'required',
            'id' => 'required',
        ]);
       
        $inp = ProposalHistory::find($req->id);
        unlink(public_path("/").$inp->file_proposal);
        $inp->delete();

        return $this->setResponse($inp);
    }

    public function dataGen($dataN = 0,$var = "",$action = "add,view,del"){
        $faker = \Faker\Factory::create();
        $exVar = explode(",",$var);
        $exAct = explode(",",$action);
        $data = [];
        $cust1 = ["Kelompok A Informatika","[IF20201A] Informatika A","Informatika","Aplikasi Booking Parkir Berbasis Web","[120011591] Dr. Zane Stroman"];
        $cust2 = ["Kelompok A Informatika","[IF20201A] Informatika A","Aplikasi Booking Parkir Berbasis Web","Informatika","Pengumpulan Revisi Latar Belakang"];

        for($i = 0;$i < 100;$i++){   
            for($j = 0;$j < $dataN;$j++){
                if($var == ""){
                    $data[$i]["idx$j"] = $faker->name;
                }
                elseif($var == "cust1"){
                    $data[$i]["idx$j"] = $cust1[$j];
                }
                elseif($var == "cust2"){
                    $data[$i]["idx$j"] = $cust2[$j];
                }
                else{
                    if($exVar[$j] == "number"){
                        $dat = $faker->randomNumber(1);
                    }
                    elseif($exVar[$j] == "year"){
                        $dat = $faker->year();
                    }
                    elseif($exVar[$j] == "name"){
                        $dat = $faker->name;
                    }
                    elseif($exVar[$j] == "date"){
                        $dat = date("Y-m-d");
                    }
                    elseif($exVar[$j] == "by"){
                        $dat = "[120011591] Dr. Zane Stroman";
                    }
                    elseif(strpos($exVar[$j],"word") !== false){
                        $exV = explode(":",$exVar[$j]);
                        if(isset($exV[1])){
                            $dat = $faker->sentence($exV[1]);
                        }else{
                            $dat = $faker->sentence(3);
                        }
                    }
                    elseif($exVar[$j] == "semester"){
                        $arr = ["2018/1","2018/2","2019/1","2019/2","2020/1","2020/2"];
                        shuffle($arr);
                        $dat = $arr[0];
                    }
                    elseif($exVar[$j] == "letter"){
                        $arr = ["A","B","C","D"];
                        shuffle($arr);
                        $dat = $arr[0];
                    }
                    $data[$i]["idx$j"] = $dat;
                }
                $data[$i]["action"] = '';
                if(in_array("add",$exAct)){
                    $data[$i]["action"] .= '<a onclick="" class="edit btn btn-success btn-sm" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i> Add</a>';
                }

                if(in_array("edit",$exAct)){
                    $data[$i]["action"] .= '<a onclick="" class="edit btn btn-warning btn-sm" data-toggle="tooltip" title="Add"><i class="fa fa-edit"></i> Edit</a>';
                }

                if(in_array("view",$exAct)){
                    $data[$i]["action"] .= '<a class="edit btn btn-primary btn-sm" onclick="viewModal()"><i class="fa fa-eye"></i> View</a>';
                }

                if(in_array("delete",$exAct)){
                    $data[$i]["action"] .= '<a onclick="" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
                }

                if(in_array("download",$exAct)){
                    $data[$i]["action"] .= '<a onclick="" class="edit btn btn-primary btn-sm"><i class="fa fa-download"></i> Download File</a>';
                }
                
                
            }   
        }

        return DataTables::of($data)
        ->addIndexColumn()
        ->rawColumns(['action','usedStatus'])
        ->make(true);

    }
}
