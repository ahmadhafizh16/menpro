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

    public function regisMhs()
    {
        return view('regismahasiswa');
    }

    public function dataGen($dataN = 0,$var = ""){
        $faker = \Faker\Factory::create();
        $exVar = explode(",",$var);
        $data = [];

        for($i = 0;$i < 100;$i++){   
            for($j = 0;$j < $dataN;$j++){
                if($var == ""){
                    $data[$i]["idx$j"] = $faker->name;
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
                    elseif($exVar[$j] == "word"){
                        $dat = $faker->sentence(3);
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
                $data[$i]["action"] = '
                <a onclick="" class="edit btn btn-success btn-sm" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i> Add</a>
                <a onclick="" class="edit btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>
                <a onclick="" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
            }   
        }

        return DataTables::of($data)
        ->addIndexColumn()
        ->rawColumns(['action','usedStatus'])
        ->make(true);

    }
}
