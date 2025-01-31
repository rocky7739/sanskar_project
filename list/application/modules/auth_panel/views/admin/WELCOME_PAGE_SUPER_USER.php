<style>
    section.panel {
        clear: both;
        height: auto;
        overflow: hidden;
    }
</style>
<div class="col-md-12">
    <h2 class="text-center"><?= CONFIG_PROJECT_ROOT_NAME ?> <span style="color:#39b5aa;"><?= CONFIG_PROJECT_FULL_NAME ?></span>  <span style="color:#FF6C60;"><?= CONFIG_PROJECT_SUBDOMAIN_NAME ?> ADMIN</span> </h2>
    <br>
</div>
<div class="clearfix"></div>
<div class=" state-overview">
    <div class="col-md-4">
        <!--follower start-->
        <section class="panel">
            <div class="follower">
                <div class="panel-body" style="background-color: #01a82db8;">
                    <h4>Today's Attendance</h4>
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <footer class="follower-foot">
                <ul>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 col-5">
                        <li>
                            <h5 class="headings">Total Employees</h5>
                            <p class="numbers"><?= $attendance_record['total_in']; ?></p>
                        </li>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                        <li>
                            <h5 class="headings">Total In</h5>
                            <p class="numbers"><?= $attendance_record['total_in']; ?></p>
                        </li>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                        <li>
                            <h5 class="headings">Total Out</h5>
                            <p class="numbers"><?= $attendance_record['total_out']; ?></p>
                        </li>
                    </div>
                </ul>
            </footer>
        </section>
        <!--follower end-->
    </div>
    <div class="col-md-4">
        <section class="panel">
            <div class="follower">
                <div class="panel-body" style="background-color: #fb050aa8;">
                    <h4>Visitor's</h4>
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <footer class="follower-foot">
                <ul>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 col-5">
                        <li>
                            <h5 class="headings">Total Visitors</h5>
                            <p class="numbers"><?= $visitor_record['total_in']; ?></p>
                        </li>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                        <li>
                            <h5 class="headings">Total In</h5>
                            <p class="numbers"><?= $visitor_record['total_in']; ?></p>
                        </li>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-3">
                        <li>
                            <h5 class="headings">Total Out</h5>
                            <p class="numbers"><?= $visitor_record['total_out']; ?></p>
                        </li>
                    </div>
                </ul>
            </footer>
        </section>
    </div>
    <div class="col-md-4">
        <section class="panel">
            <div class="follower">
                <div class="panel-body" style="background-color: #337ab7;">
                    <h4>Gate Pass</h4>
                    <i class="fa fa-ticket"></i>
                </div>
            </div>
            <footer class="follower-foot">
                <ul>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                        <li>
                            <h5 class="headings">Total In</h5>
                            <p class="numbers">0</p>
                        </li>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4"></div>
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                        <li>
                            <h5 class="headings">Total Out</h5>
                            <p class="numbers">0</p>
                        </li>
                    </div>
                </ul>
            </footer>
        </section>
    </div>
</div>


<div class="clearfix"></div>