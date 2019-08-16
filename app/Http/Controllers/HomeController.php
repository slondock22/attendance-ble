<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\BleEvent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use Image;
use File;


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

  

    public function registration(Request $request){

        $validator = Validator::make($request->all(),[
            'name'      => 'required|string',
            'date_of_birth'     => 'required|date_format:Y-m-d',
            'filepath' => 'required|image|mimes:jpg,png,jpeg',
            'email' => 'required|string|email|max:255|unique:users',

        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
        
         //Create Directory if not exists
        if(!File::isDirectory($this->path)){
            File::makeDirectory($this->path);
        }
        
        $file = $request->file('filepath');
        $filename = $file->getClientOriginalName();
        $filepath = $this->path.'/'.$filename;

        Image::make($file)->save($filepath);


        $save = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'filepath' => $filename,
            'password' => Hash::make('admin123'),
        ]);

        $id_profile = $save->id;

        $data = [
            'message' => 'succeess',
            'id_profile' => $id_profile,
        ];

        return response()->json($data,200);
    }

    public function ble(Request $request){
        $uuid   = $request->uuid;
        $major  = $request->major;
        $minor  = $request->minor;
        $type   = $request->type;

        event(new BleEvent($uuid, $major, $minor, $type));
        return response()->json('success',200);
    }
}
