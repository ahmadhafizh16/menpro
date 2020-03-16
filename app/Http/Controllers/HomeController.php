<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(Auth::user()->name == "mhs") return redirect("/regis");
        return view('home');
    }
    
    public function landingPage(){
        return view('landingPage');
    }

    public function jurusan()
    {
        return view('jurusan');
    }
    
    public function setKelas()
    {
        return view('kelas');
    }

    public function tahunAjaran()
    {
        return view('tahunAjaran');
    }

    public function uplProposal()
    {
        return view('uplProposal');
    }

    public function uplBanner()
    {
        return view('uplBanner');
    }

    public function dataKelompok()
    {
        return view('dataKelompok');
    }

    public function dataProposal()
    {
        return view('dataProposal');
    }
    
    public function createPengumuman()
    {
        return view('createPengumuman');
    } 

    public function regisMhs()
    {
        return view('regismahasiswa');
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
