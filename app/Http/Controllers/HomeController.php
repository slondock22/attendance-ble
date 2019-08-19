<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\BleEvent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use Image;
use File;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public $path;

    public function __construct()
    {
        $this->path = storage_path('app/public/image');
    }


    public function index()
    {
        return view('home');
    }

    public function attendance()
    {
        return view('attendance');
    }

    public function gate()
    {
        return view('gate');
    }

    public function ble(Request $request){
        $uuid        = $request->uuid;
        $major       = $request->major;
        $minor       = $request->minor;
        $type        = $request->type;
        $id_profile  = $request->id_profile;

        event(new BleEvent($uuid, $major, $minor, $type, $id_profile));
        return response()->json('success',200);
    }
  

    public function registration(Request $request){

        $validator = Validator::make($request->all(),[
            'name'      => 'required|string',
            'date_of_birth'     => 'required|date_format:Y-m-d',
            // 'filepath' => 'required|image|mimes:jpg,png,jpeg',
            'email' => 'required|string|email|max:255|unique:users',

        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
        
        //  //Create Directory if not exists
        // if(!File::isDirectory($this->path)){
        //     File::makeDirectory($this->path);
        // }
        
        // $file = $request->file('filepath');
        // $filename = $file->getClientOriginalName();
        // $filepath = $this->path.'/'.$filename;

        // Image::make($file)->save($filepath);


        $save = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            // 'filepath' => $filename,
            'password' => Hash::make('admin123'),
        ]);

        $id_profile = $save->id;

        if($save){
            $data = [
                'message' => 'Success',
                'id_profile' => $id_profile,
            ];
            $code = 200;
        }else{
            $data = [
                'message' => 'Error When Inserting'
            ];
            $code = 500;
        }
       

        return response()->json($data,$code);
    }

    public function getProfile(Request $request){

        $validator = Validator::make($request->all(),[
            'id_profile'      => 'required|string|max:1',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        $user = User::findOrFail($request->id_profile);
        
        if($user){
            $data = [
                'message' => 'Success',
                'id'    => $user->id,
                'name' => $user->name,
                'date_of_birth' => $user->date_of_birth,
                'email' => $user->email
            ];
            $code = 200;
        }else{
            $data = [
                'message' => 'Data Not Found'
            ];
            $code = 500;
        }

        return response()->json($data,$code);
    }

}
