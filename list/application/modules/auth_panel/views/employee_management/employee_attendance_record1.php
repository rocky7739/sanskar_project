<?php
$year = date('Y');
$month = date('m');
$day = date('d');
$month_last_day = date('t');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Home Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />  
        <link rel="stylesheet" type="text/css" media="screen" href="http://13.232.24.221/BaseSquadz/website_assets/css/style.css" /> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    </head>
    <style type="text/css">
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        ul{
            list-style-type: none;
            text-align: center;
            margin-bottom: 0px;
        }
        li:not(:first-child){
            cursor: pointer;
        }
        .table td, .table th{
            padding: 8px 12px;
        }
        .calender{
            width: 90%;
            margin: auto;
            box-shadow: 2px 2px 4px rgba(0,0,0,.5);
        }
        .calender .month{
            background-color: #1866b1;
            padding: 5px;
            color: #ecf0f1;
            width: 100%;
            position: relative;
        }
        .calender .month .next,.calender .month .prev{
            position: absolute;
            top: calc(50% - 15px);
            cursor: pointer;
            padding: 5px;
            display: block;
        }
        .calender .month .prev{
            left: 10px;
            display: none;
        }
        .calender .month .next{
            right: 10px;
            display: none;
        }
        .calender .month .next:hover,.calender .month .prev:hover{
            background-color: rgba(0,0,0,.2);
        }
        .calender .weeks{display: flex;}
        .calender .weeks li{
            background-color:aliceblue!important;
            flex: 1;
            opacity: .5;
            color: #000;
            position: relative;
            animation: motion 2s;
            padding: 10px; 
        }
        .calender .weeks li:hover{background-color: rgba(0,0,0,.2);}

        .calender .days {
            display: flex;
            flex-wrap: wrap;
        }
        .calender .days li{
            flex-basis: calc(100% / 7);/*???? ??????? ??? ???? ???? ?? ???? ??????? ?? ?? ??*/
            padding: 30px 0;
            opacity: .7;
            background-color: #bdc3c7;
            color: #fff;
            border: 1px solid;
        }
        .calender .days li:hover{background-color: rgba(0,0,0,.3);}
        .black{
            color: #000;
            font-weight: inherit;
            background: #ccc;
            font-weight: bolder;
            border-radius: 1px solid #fff;
        }
        .absent{
            color: #fff;
            font-weight: inherit;
            background: #f10303ab;
        }
        .holiday{
            color: #fff;
            background: #1866b1b8;
            font-weight: inherit;
        }
        .present{
            color: #fff;
            font-weight: inherit;
            background: #03730385;
        }
        .halfday{
            background: #ab5104b8;
            color: #fff;
            font-weight: inherit;
        }
        .panel-heading {
            background: #e9e9e9 none repeat scroll 0 0;
        }
    </style>
    <div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading"> Attendance Report 
        </header>
        <div class="panel-heading col-sm-12">
            <div class="form-group col-sm-1">
                <select class="form-control" id="year_sellect">
                    <option value="2020" <?= ($year == '2020') ? 'selected' : '' ?>>2020</option>
                    <option value="2021" <?= ($year == '2021') ? 'selected' : '' ?>>2021</option>
                </select>
            </div>
            <div class="form-group col-sm-1">
                <select class="form-control" id="month_sellect">
                    <option value="01" <?= ($month == '01') ? 'selected' : '' ?>>January</option>
                    <option value="02" <?= ($month == '02') ? 'selected' : '' ?>>February</option>
                    <option value="03" <?= ($month == '03') ? 'selected' : '' ?>>March</option>
                    <option value="04" <?= ($month == '04') ? 'selected' : '' ?>>April</option>
                    <option value="05" <?= ($month == '05') ? 'selected' : '' ?>>May</option>
                    <option value="06" <?= ($month == '06') ? 'selected' : '' ?>>June</option>
                    <option value="07" <?= ($month == '07') ? 'selected' : '' ?>>July</option>
                    <option value="08" <?= ($month == '08') ? 'selected' : '' ?>>August</option>
                    <option value="09" <?= ($month == '09') ? 'selected' : '' ?>>September</option>
                    <option value="10" <?= ($month == '10') ? 'selected' : '' ?>>October</option>
                    <option value="11" <?= ($month == '11') ? 'selected' : '' ?>>November</option>
                    <option value="12" <?= ($month == '12') ? 'selected' : '' ?>>December</option>
                </select>
            </div>
        </div>

            <div  id="table_attendance">
                <div class="table-responsive">
                    <!-- <h2>Attendance Table</h2>  -->          
                    <table class="table table-bordered" style="margin-top: 12px;">
                        <thead class="black">
                            <tr>
                                <th>S.N.</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>Total Time(H:M)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="black">1</td>

                                <td class="holiday">2021-08-01</td>
                                <td class="holiday">Sun</td>
                                <td colspan="4" class="text-center holiday">HOLIDAY</td>
                            </tr>
                            <tr>
                                <td class="black">2</td>

                                <td class="present">2021-08-02</td>  
                                <td class="present">Mon</td>  
                                <td class="present">09:58:03 AM</td>
                                <td class="present">07:33:08 PM</td>
                                <td class="present">9 hours  35 minuts  </td>
                                <td class="present">Present</td> 
                            </tr>
                            <tr>
                                <td class="black">3</td>

                                <td class="present">2021-08-03</td>  
                                <td class="present">Tue</td>  
                                <td class="present">09:56:58 AM</td>
                                <td class="present">09:00:00 PM</td>
                                <td class="present">9 hours  10 minuts  </td>
                                <td class="present">Present</td> 
                            </tr>
                            <tr>
                                <td class="black">4</td>

                                <td class="present">2021-08-04</td>  
                                <td class="present">Wed</td>  
                                <td class="present">03:20:23 PM</td>
                                <td class="present">07:37:20 PM</td>
                                <td class="present">4 hours  16 minuts  </td>
                                <td class="present">Present</td> 
                            </tr>
                            <tr>
                                <td class="black">5</td>

                                <td class="present">2021-08-05</td>  
                                <td class="present">Thu</td>  
                                <td class="present">09:57:01 AM</td>
                                <td class="present">08:00:00 PM</td>
                                <td class="present">9 hours  30 minuts  </td>
                                <td class="present">Present</td> 
                            </tr>
                            <tr>
                                <td class="black">6</td>

                                <td class="absent">2021-08-06</td>  
                                <td class="absent">Fri</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">7</td>

                                <td class="holiday">2021-08-07</td>
                                <td class="holiday">Sat</td>
                                <td colspan="4" class="text-center holiday">HOLIDAY</td>
                            </tr>
                            <tr>
                                <td class="black">8</td>

                                <td class="holiday">2021-08-08</td>
                                <td class="holiday">Sun</td>
                                <td colspan="4" class="text-center holiday">HOLIDAY</td>
                            </tr>
                            <tr>
                                <td class="black">9</td>

                                <td class="present">2021-08-09</td>  
                                <td class="present">Mon</td>  
                                <td class="present">10:28:09 AM</td>
                                <td class="present">07:36:10 PM</td>
                                <td class="present">9 hours  8 minuts  </td>
                                <td class="present">Present</td> 
                            </tr>
                            <tr>
                                <td class="black">10</td>

                                <td class="present">2021-08-10</td>  
                                <td class="present">Tue</td>  
                                <td class="present">10:17:44 AM</td>
                                <td class="present">07:30:04 PM</td>
                                <td class="present">9 hours  12 minuts  </td>
                                <td class="present">Present</td> 
                            </tr>
                            <tr>
                                <td class="black">11</td>

                                <td class="present">2021-08-11</td>  
                                <td class="present">Wed</td>  
                                <td class="present">10:25:50 AM</td>
                                <td class="present">07:45:04 PM</td>
                                <td class="present">9 hours  19 minuts  </td>
                                <td class="present">Present</td> 
                            </tr>
                            <tr>
                                <td class="black">12</td>

                                <td class="absent">2021-08-12</td>  
                                <td class="absent">Thu</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">13</td>

                                <td class="present">2021-08-13</td>  
                                <td class="present">Fri</td>  
                                <td class="present">09:16:08 AM</td>
                                <td class="present">--</td>
                                <td class="present">time is running </td>
                                <td class="present">Present</td> 
                            </tr>
                            <tr>
                                <td class="black">14</td>

                                <td class="holiday">2021-08-14</td>
                                <td class="holiday">Sat</td>
                                <td colspan="4" class="text-center holiday">HOLIDAY</td>
                            </tr>
                            <tr>
                                <td class="black">15</td>

                                <td class="holiday">2021-08-15</td>
                                <td class="holiday">Sun</td>
                                <td colspan="4" class="text-center holiday">HOLIDAY</td>
                            </tr>
                            <tr>
                                <td class="black">16</td>

                                <td class="absent">2021-08-16</td>  
                                <td class="absent">Mon</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">17</td>

                                <td class="absent">2021-08-17</td>  
                                <td class="absent">Tue</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">18</td>

                                <td class="absent">2021-08-18</td>  
                                <td class="absent">Wed</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">19</td>

                                <td class="absent">2021-08-19</td>  
                                <td class="absent">Thu</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">20</td>

                                <td class="absent">2021-08-20</td>  
                                <td class="absent">Fri</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">21</td>

                                <td class="holiday">2021-08-21</td>
                                <td class="holiday">Sat</td>
                                <td colspan="4" class="text-center holiday">HOLIDAY</td>
                            </tr>
                            <tr>
                                <td class="black">22</td>

                                <td class="holiday">2021-08-22</td>
                                <td class="holiday">Sun</td>
                                <td colspan="4" class="text-center holiday">HOLIDAY</td>
                            </tr>
                            <tr>
                                <td class="black">23</td>

                                <td class="absent">2021-08-23</td>  
                                <td class="absent">Mon</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">24</td>

                                <td class="absent">2021-08-24</td>  
                                <td class="absent">Tue</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">25</td>

                                <td class="absent">2021-08-25</td>  
                                <td class="absent">Wed</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">26</td>

                                <td class="absent">2021-08-26</td>  
                                <td class="absent">Thu</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">27</td>

                                <td class="absent">2021-08-27</td>  
                                <td class="absent">Fri</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">28</td>

                                <td class="holiday">2021-08-28</td>
                                <td class="holiday">Sat</td>
                                <td colspan="4" class="text-center holiday">HOLIDAY</td>
                            </tr>
                            <tr>
                                <td class="black">29</td>

                                <td class="holiday">2021-08-29</td>
                                <td class="holiday">Sun</td>
                                <td colspan="4" class="text-center holiday">HOLIDAY</td>
                            </tr>
                            <tr>
                                <td class="black">30</td>

                                <td class="absent">2021-08-30</td>  
                                <td class="absent">Mon</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>
                            <tr>
                                <td class="black">31</td>

                                <td class="absent">2021-08-31</td>  
                                <td class="absent">Tue</td>
                                <td colspan="4" class="text-center absent">Absent</td>
                            </tr>

                        </tbody>
                    </table>
                </div>e3

            </div>
        </div>
    </div>
    <script type="text/javascript">
        /*global console*/
        //calender
        //month
        //prev
        //next
        //weeks
        //days

        //punblic variables
        var calender = document.querySelector(".calender"), //container of calender
                topDiv = document.querySelector('.month'),
                monthDiv = calender.querySelector("h4"), //h1 of monthes
                yearDiv = calender.querySelector('h6'), //h2 for years
                weekDiv = calender.querySelector(".weeks"), //week container
                dayNames = weekDiv.querySelectorAll("li"), //dayes name
                dayItems = calender.querySelector(".days"), //date of day container
                prev = calender.querySelector(".prev"),
                next = calender.querySelector(".next"),
                // date variables
                years = new Date().getFullYear(),
                monthes = new Date(new Date().setFullYear(years)).getMonth(),
                lastDayOfMonth = new Date(new Date(new Date().setMonth(monthes + 1)).setDate(0)).getDate(),
                dayOfFirstDateOfMonth = new Date(new Date(new Date().setMonth(monthes)).setDate(1)).getDay(),
                // array to define name of monthes
                monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"],
                colors = ['000000'],
                i, //counter for day before month first day in week
                x, //counter for prev , next
                counter;//counter for day of month  days;


        //display dayes of month in items
        function days(x) {
            'use strict';
            dayItems.innerHTML = "";
            monthes = monthes + x;

            /////////////////////////////////////////////////
            //test for last month useful while prev ,max prevent go over array
            if (monthes > 11) {
                years = years + 1;
                monthes = new Date(new Date(new Date().setFullYear(years)).setMonth(0)).getMonth();//???? ????? ???? ??? ?? ????? ???????
            }
            if (monthes < 0) {
                years = years - 1;
                monthes = new Date(new Date(new Date().setFullYear(years)).setMonth(11)).getMonth();//???? ????? ???? ??? ?? ????? ???? ????
            }
            //???? ??? ??? ???? ??? ?? ????? ???? ????? ????? ?????? ?? next,prev
            lastDayOfMonth = new Date(new Date(new Date(new Date().setFullYear(years)).setMonth(monthes + 1)).setDate(0)).getDate();//??? ??? ?? ?????
            dayOfFirstDateOfMonth = new Date(new Date(new Date(new Date().setFullYear(years)).setMonth(monthes)).setDate(1)).getDay();//????? ????? ?? ?? ??? ?? ???? ????????
            /////////////////////////////////////////////////

            yearDiv.innerHTML = years;
            monthDiv.innerHTML = monthNames[monthes];
            for (i = 0; i <= dayOfFirstDateOfMonth; i = i + 1) {
                if (dayOfFirstDateOfMonth === 6) {
                    break;
                }
                dayItems.innerHTML += "<li> - </li>";
            }


            for (counter = 1; counter <= lastDayOfMonth; counter = counter + 1) {
                var dyanamicdata = $('.atte' + counter).val();
                var current_date = $('.current_date').val();
                if (dyanamicdata == counter) {
                    console.log(dyanamicdata);
                    dayItems.innerHTML += "<li class='click_details' style='background:green;'>" + (counter) + "</li>";
                } else if (current_date > counter) {
                    dayItems.innerHTML += "<li class='click_details' style='background:red;'>" + (counter) + "</li>";
                } else {
                    dayItems.innerHTML += "<li class='click_details' style='background:#000;'>" + (counter) + "</li>";
                }

            }
            topDiv.style.background = colors[monthes];
            dayItems.style.background = colors[monthes];
            //????? ????? ??????
            if (monthes === new Date().getMonth() && years === new Date().getFullYear()) {
                //?? ???? ??????? ?????? =??????? ?????
                dayItems.children[new Date().getDate() + dayOfFirstDateOfMonth].style.background = "#2ecc71";
            }
        }
        prev.onclick = function () {
            'use strict';
            days(-1);//decrement monthes
        };
        next.onclick = function () {
            'use strict';
            days(1);//increment monthes
        };
        days(0);

        //end

        $('.click_details').click(function () {
            var date = $(this).html();
            //alert(date);
            jQuery.ajax({
                url: "http://13.232.24.221/BaseSquadz/index.php/web_panel/Attendance/changedate",
                method: "post",
                dataType: "json",
                data: {
                    date: date,
                },
                success: function (data) {
                    if (data.status == true) {
                        //Swal.fire('work done');
                        console.log(data.data.data);
                        if (data.data.data != null) {
                            $('#my_attendance_date').html(data.data.data.date);
                            $('#my_attendance_in_time').html(data.data.data.in_time);
                            $('#my_attendance_day').html(data.data.data.day);
                            $('#my_attendance_out_time').html(data.data.data.out_time);
                            $('#my_working_time').html(data.data.data.total_time);
                        } else {
                            Swal.fire('no attendence found');
                        }

                    } else {
                        Swal.fire('something went worng');
                    }
                }
            });
        })
    </script>

    <script>
        // month wise attendance ===================================
        $(document).ready(function () {
            $("select#month_sellect").change(function () {
                var month = $(this).children("option:selected").val();
                var year = $('#year_sellect').children("option:selected").val();
                if (month == '') {
                    $('#month_sellect').after('<div class="alert alert-danger">Pls select your month</div>');
                    $('#month_sellect').focus();
                    return false;
                }

                jQuery.ajax({
                    url: "http://13.232.24.221/BaseSquadz/index.php/web_panel/Attendance/ajax_get_month_wise_attendance",
                    method: "post",
                    //dataType: "json",
                    data: {
                        month: month,
                        year: year,
                    },
                    success: function (data) {
                        if (data) {
                            $('#table_attendance').html(data);
                        } else {
                            Swal.fire('Invaild user');
                        }
                    }
                });


            });
        });
    </script>
