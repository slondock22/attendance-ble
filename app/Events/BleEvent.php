<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;
use DB;

class BleEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $uuid;
    public $major;
    public $minor;
    public $type;
    public $id_profile;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($uuid, $major, $minor, $type, $id_profile)
    {
        //
        // dd($data);
        $this->uuid     = $uuid;
        $this->major    = $major;
        $this->minor    = $minor;
        $this->type     = $type;
        $this->id_profile     = $id_profile;
        $this->data = $this->getData($type, $id_profile, $minor);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return ['blereceiver'];
    }

    public function broadcastAs()
    {
        return 'BleEvent';
    }

    public function getData($type, $id_profile, $minor){

    //   dd($id_profile);
     
        if($type == 'profile'){
            $profile = User::findOrFail($id_profile);
            $data = [
                        'id'   => $profile->id,
                        'name' => $profile->name,
                        'date_of_birth' => $profile->date_of_birth,
                        'email' => $profile->email
            ];
            return $data;
        }
        elseif($type == 'attendance'){
            $absenid = DB::table('absens')->insertGetId(
                                                ['user_id' => $id_profile,
                                                'check_in' => date('Y-m-d H:i:s')]
            );

            if($absenid){
                $absen = DB::table('absens')->join('users','absens.user_id','users.id')->select('users.id','users.name','absens.check_in')->where('id',$absenid)->first();
                
                $data  = [
                            'id' => $absen->id,
                            'name' => $absen->name,
                            'check_in' => date('H:i:s', strtotime($absen->check_in)),
                            'date' => date('Y/m/d', strtotime($absen->check_in))
                ];

                return $data;
            }
        }
        elseif($type == 'gate'){
            $gateid = DB::table('gates')->insertGetId(
                                        ['user_id' => $id_profile,
                                        'gate_in' => date('Y-m-d H:i:s')]
                        );
            // dd($gate    id);
            $gate = DB::table('gates')->where('id',$gateid)->first();
            if($minor == 361){
                $img = 'checked.png';
            } else {
                $img = 'cancel.png';
            }
            $data = [
                'id' => $gate->id,
                'gate_in' => date('H:i:s', strtotime($gate->gate_in)),
                'date' => date('Y/m/d', strtotime($gate->gate_in)),
                'img' => $img,
                'minor' => $minor
            ];
            
            return $data;
        }

    }
}
