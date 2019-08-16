@extends('layouts.app')
<style>
    .mb-10{
        margin-bottom: 10px !important;
    }
     .profile-labels{
        text-align: center;
    }
    .profile-details{
        margin-bottom: .5rem; 
        text-align:center;
        font-size: 16pt;
        font-weight: 500;
    }

    .fl-card{
        background-color: white !important;
        box-shadow: 0px 16px 44.82px 9.18px rgba(33, 55, 130, 0.1);
        border-radius: 15px;
    }

    .fl-card-header{
        background-color: #e78c0e !important;
        color: white;
        text-align: center;
        padding: 20px;
        font-size: 20px;
        font-weight: bold;
        border-radius: 10px 10px 0px 0px;
    }

    .fl-card-header2{
        background-color: #01276a !important;
        color: white;
        padding:15px 10px 15px 25px;
    }

    .fl-card-body{
        padding:15px 0px 15px 0px;
        background-color: #fff;
        border-radius: 0px 0px 10px 10px;
    }

    .fl-table-header{
        width: 100%;
    }

    .fl-table-header td{
        color: #fff;
    }

    .fl-table{
        width: 100%;
    }

    .fl-table td{
        padding:20px 20px; 
    }

    .mt-10{
        margin-top:10px;
    }
</style>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        
@section('content')

<div class="container" style="max-width:1640px;">
    <div class="row">
        <div class="col-md-3">
            <div class="fl-card mt-10">
                <div class="fl-card-header">Profile</div>                
                <div class="fl-card-body" style="padding-top:40px; padding-bottom:70px">
                    <img src="{{asset('img/boy.png')}}" class="mx-auto d-block rounded-circle img-thumbnail mb-10">
                    <div class="profile-labels">Fullname</div>
                    <div class="profile-details">
                        Andi Barusman
                    </div>
                    <div class="profile-labels">Date of Birth</div>
                    <div class="profile-details"> 
                        15 Agustus 2019
                    </div>
                    <div class="profile-labels">Emails</div>
                    <div class="profile-details"> 
                        barusmancodot@gmail.com
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="fl-card mt-10">
                <div class="fl-card-header">Attendance</div>
                <div class="fl-card-header2">
                    <table class="fl-table-header">
                        <tr>
                            <td width="35%"><i class="fa fa-calendar"></i>&nbsp; &nbsp;Date</td>
                            <td width="35%"><i class="fa fa-arrow-up"></i>&nbsp; &nbsp;Check In/Out</td>
                            <td width="25%"><i class="fa fa-comment"></i>&nbsp; &nbsp;Notes</td>
                        </tr>
                    </table>
                </div>
                <div class="fl-card-body">
                    <table class="fl-table">
                       <tbody>
                           @for($i=0;$i<=10;$i++)
                                @if($i%2==0)
                                    @php $color = "#f3f3f3";@endphp
                                @else
                                    @php $color = "#fff";@endphp
                                @endif
                            <tr style="background-color:{{$color}}">
                            <td width="35%" scope="row">2019 Aug 06</td>
                            <td width="35%">09:15:00</td>
                            <td width="25%">-</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
                <div class="fl-card mt-10">
                        <div class="fl-card-header">Automation Gate</div>
                        <div class="fl-card-header2">
                            <table class="fl-table-header" cellpadding="7">
                                <tr>
                                    <td width="40%"><i class="fa fa-truck"></i>&nbsp; &nbsp;Truck</td>
                                    <td align="center" width="20%"><i class="fa fa-arrow-up"></i>&nbsp; &nbsp;Gate In/Out</td>
                                    <td align="center" width="15%"><i class="fa fa-star"></i>&nbsp; &nbsp;Status</td>
                                </tr>
                            </table>
                        </div>

                    <div class="fl-card-body">
                        <table class="fl-table">
                            <tbody>
                                @for($i=0;$i<=9;$i++)
                                    @if($i%2==0)
                                <tr>
                                <td width="40%" scope="row">c8bd08fb-756d-4c9e-8d0a-13238</td>
                                <td align="center" width="20%">09:15:00</td>
                                <td width="15%" align="center"><img src="{{asset('img/checked.png')}}"></td>
                                </tr>
                                    @else
                                <tr>
                                <td scope="row">c8bd08fb-756d-4c9e-8d0a-13878</td>
                                <td align="center">09:15:00</td>
                                <td align="center"><img src="{{asset('img/cancel.png')}}"></td>
                                </tr>
                                    @endif
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script>
      Pusher.logToConsole = true;
        var pusher = new Pusher('2e01f02ee376d2e8845e', {
        forceTLS: true,
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('blereceiver');
      
    channel.bind('BleEvent', function(data) {
//         
        console.log(data);
           
    });
</script>
@endsection
