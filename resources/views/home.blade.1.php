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
    .card-header{
        background-color: #e78c0e !important;
        color: white;
        text-align: center;
    }
</style>
        
@section('content')

<div class="container" style="max-width:1640px;">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">My Profile</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <img src="{{asset('img/boy.png')}}" class="mx-auto d-block rounded-circle img-thumbnail mb-10">
                    <div class="profile-labels">Fullname</div>
                    <div class="profile-details">
                        Andi Barusman
                    </div>
                    <div class="profile-labels">Date of Birth</div>
                    <div class="profile-details"> 
                        15 Agustus 2019
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">Attendance</div>
                <div class="card-body">
                    <div style="height:30px; background-color:203782"> aaaa</div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Check In</th>
                            <th scope="col">Check Out</th>
                            <th scope="col">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">2019 Aug 06</th>
                            <td>09:15:00</td>
                            <td>09:15:00</td>
                            <td>-</td>
                            </tr>
                            <tr>
                            <th scope="row">2019 Aug 06</th>
                            <td>09:15:00</td>
                            <td>09:15:00</td>
                            <td>-</td>
                            </tr>
                            <tr>
                            <th scope="row">2019 Aug 06</th>
                            <td>09:15:00</td>
                            <td>09:15:00</td>
                            <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-5">
                <div class="card">
                    <div class="card-header">Automation Gate</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">Truck</th>
                                <th scope="col">Gate In</th>
                                <th scope="col">Gate Out</th>
                                <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">c8bd08fb-756d-4c9e-8d0a-13fece61a0d6</th>
                                <td>09:15:00</td>
                                <td>09:15:00</td>
                                <td align="center"><img src="{{asset('img/checked.png')}}"></td>
                                </tr>
                                <tr>
                                <th scope="row">c8bd08fb-756d-4c9e-8d0a-13fece61a0d6</th>
                                <td>09:15:00</td>
                                <td>09:15:00</td>
                                <td align="center"><img src="{{asset('img/cancel.png')}}"></td>
                                </tr>
                                <tr>
                                <th scope="row">c8bd08fb-756d-4c9e-8d0a-13fece61a0d6</th>
                                <td>09:15:00</td>
                                <td>09:15:00</td>
                                <td align="center"><img src="{{asset('img/checked.png')}}"></td>
                                </tr>
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
            alert('hai');
    });
</script>
@endsection
