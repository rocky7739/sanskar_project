<?php
$year = date('Y');
$month = date('m');
$day = date('d');
$month_last_day = date('t');
$emp_code=$employee_details['EmpCode'];
?>

<style>
    .panel-heading {
        background: #e9e9e9 none repeat scroll 0 0;
    }
</style>

<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading"> Monthly Attendance Report 
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
        <div class="panel-body">
            <div class="adv-table">
                <table  class="display table table-bordered table-striped" id="all-video-grid">
                    <thead>
                        <tr>
                            <th class="no-sort">S.N.</th>
                            <th class="no-sort">Date</th>
                            <th class="no-sort">Day</th>
                            <th class="no-sort">In Time</th>
                            <th class="no-sort">Out Time</th>
                            <th class="no-sort">Total Time(H:M)</th>
                            <th class="no-sort">Status</th>
                        </tr>
                    </thead>
<!--                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                             <th></th>
                        </tr>
                    </thead>-->
                </table>
            </div>
        </div>
    </section>
</div>

<?php
$adminurl = AUTH_PANEL_URL;
$custum_js = <<<EOD
              <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
              <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
               <script type="text/javascript" language="javascript" >

                   jQuery(document).ready(function() {
                       var table = 'all-video-grid';
                       var dataTable = jQuery("#"+table).DataTable( {
                           "processing": true,
                           "language": {
                                "processing": "<i class='fa fa-spin  fa-spinner fa-4x' style='z-index:999'><i>" //add a loading image,simply putting <img src="loader.gif" /> tag.
                            },
                            "pageLength": 25,
                            "lengthMenu": [[25, 100, 250], [25, 100, 'ALL']],
                           "serverSide": true,
                           "order": [[ 0, "desc" ]],
                            "columnDefs": [
                                { "orderable": false, "targets": 'no-sort'}
                              ],
                           "ajax":{
                               url :"$adminurl"+"employee_management/attendance_report/ajax_employee_attendance_record/?emp_code=$emp_code", // json datasource
                               type: "post",  // method  , by default get
                               error: function(){  // error handling
                                   jQuery("."+table+"-error").html("");
                                   jQuery("#"+table+"_processing").css("display","none");
                               }
                           }
                       } );
                       jQuery("#"+table+"_filter").css("display","none");
                       $('.search-input-text').on( 'keyup click', function () {   // for text boxes
                           var i =$(this).attr('data-column');  // getting column index
                           var v =$(this).val();  // getting search input value
                           dataTable.columns(i).search(v).draw();
                       } );
                        $('.search-input-select').on( 'change', function () {   // for select box
                            var i =$(this).attr('data-column');
                            var v =$(this).val();
                            dataTable.columns(i).search(v).draw();
                        } );
						// Re-draw the table when the a date range filter changes
                        $('.date-range-filter').change(function() {
                            if($('#min-date-video-list').val() !="" && $('#max-date-video-list').val() != "" ){
                                var dates = $('#min-date-video-list').val()+','+$('#max-date-video-list').val();
                                dataTable.columns(8).search(dates).draw();
                            } 
                            if($('#min-date-video-list').val() =="" || $('#max-date-video-list').val() == "" ){
                                var dates = "";
                                dataTable.columns(8).search(dates).draw();
                            }  
                        }); 
                   } );
               </script>
               <script>
                // month wise attendance ===================================
              $(document).ready(function(){
                  $("select#month_sellect").change(function(){
                      var month = $(this).children("option:selected").val();
                      var year = $('#year_sellect').children("option:selected").val();
                      if(month == ''){
                        $('#month_sellect').after('<div class="alert alert-danger">Pls select your month</div>');
                        $('#month_sellect').focus();
                        return false;
                      }

                        jQuery.ajax({
                              url :"$adminurl"+"employee_management/attendance_report/ajax_employee_attendance_record/?emp_code=$emp_code", // json datasource
                              method: "post", 
                              //dataType: "json",
                              data: {
                                  month: month,
                                  year: year,
                              },
                              success: function (data) {
                                if (data){
                                    $('#table_attendance').html(data);
                                } else {
                                    Swal.fire('Invaild user');
                                }
                              }
                          });


                  });
              });
              </script>

        

EOD;

echo modules::run('auth_panel/template/add_custum_js', $custum_js);
?>
