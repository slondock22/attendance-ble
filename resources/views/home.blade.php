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
                        <span id="name">Andi Barusman</span>
                    </div>
                    <div class="profile-labels">Date of Birth</div>
                    <div class="profile-details"> 
                            <span id="date_of_birth">15 Agustus 2019</span>
                    </div>
                    <div class="profile-labels">Emails</div>
                    <div class="profile-details"> 
                            <span id="email">barusmancodot@gmail.com</span>
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
                    <table class="fl-table" id="attendance_table">
                       <tbody>
                          
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
                        <table class="fl-table" id="gate_table">
                            <tbody>
                                
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
       if(data.type == 'profile'){
            $('#name').html(data.data.name);
            $('#date_of_birth').html(data.data.date_of_birth);
            $('#email').html(data.data.email);
       }
       else if(data.type == 'attendance'){
            var date = data.data.date;
            var check_in = data.data.check_in;
            var row = "<tr><td>" + date + "</td><td>" + check_in + "</td><td>-</td> </tr>";
            $("#attendance_table").append(row);

       }else if(data.type == 'gate'){
            var date = data.data.date;
            var check_in = data.data.gate_in;
            var row = "<tr><td>" + date + "</td><td>" + gate_in + "</td><td>-</td> </tr>";
            $("#gate_table").append(row);
       }

           
    });
</script>
@endsection
