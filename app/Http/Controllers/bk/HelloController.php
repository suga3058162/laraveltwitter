<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
// use Input;
use Illuminate\Support\Facades\Input;
class HelloController extends Controller
{

    // protected $request;

    // public function __construct(Request $request)
    // {
    //     $this->request = $request;
    //     $this->MasterWage = \App::make('\App\MasterWage');
    // }

       // public function __construct(Request $request)
       // {
       //     $this->request = $request;
       //     // $this->UserSkillModel = \App::make('\App\Models\UserSkill');
       // }

    // public function index(Request $request){
        // $wages = $this->MasterWageModel->all();

        // $data = DB::select('master_workdays')->get();

        // $data['test'] = 10;
        // $data['hoge'] = 6;

        //配列内で指定しないと表示されない
        // $data = array(6);
        // dd($data);

        // $data = array_merge(compact('test','hoge','wages'));

        // $data = DB::select("SELECT * FROM table1");

        // return view('hello.index', $data);
    // }


    //form表示
    // public function input(){
    //     return view('input');
    // }
    //受取と保存
    // public function res(){
    //
    //     $name = Input::get('name');
    //
    //     DB::table('table1')->insert([
    //             'name'=>$name,
    //         ]);
    //
    //     return "Saved";
    // }
    //一覧表示
    // public function select(){
    //
    //     $members = DB::table('table1')->get();
    //     return view('select')->with('names',$names);
    // }

    public function index(){
        // $user = Auth::user();
        // $skillGroups = $this->UserSkillModel->getSkillsWithLevelByUserId($user->id);

        // $data = DB::select('master_workdays')->get();
        // return view('hello.index', compact('data'));

        //PDO
        // Route::get('pdo',function(){
        //
        // $name = "hoge";
        // $dbh = DB::connection()->getPdo();
        //
        // $stmt = $dbh->prepare("select * from admin_mail_lists where email = :email");
        // $stmt->bindParam(':email',$email);
        // $stmt->execute();
        //
        // foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
        // {
        //     echo $row['id']." ".$row['email']."<br>";
        // }
        //
        // return;
        // });

        // $users = DB::select('select * from admin_informations where email=1');
        // return view('hello.index', ['users' => $users]);
        $data = DB::select('SELECT * FROM table1');
        // $data = DB::select("SELECT * FROM table1")->where('name', $data->id)->get();
        //dd($data[0]-);
        $useData = $data[0];
        $viewData['user'] =  $useData;



        // table1へ書き込み
        // $name = Input::get('name');
        // DB::table('table1')->insert([
        //         'name'=>$name,
        //     ]);
        // return "Saved";

        return view('hello.index',compact('viewData'));
    }
    function post(){
      DB::table('table1')->insert([
        'name'=>Input::get('name')
      ]);
      return 'Successfully done!';
    }
}
