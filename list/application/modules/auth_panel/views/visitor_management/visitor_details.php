<style>
    .panel-heading {
        background: #e9e9e9 none repeat scroll 0 0;
    }
</style>
<?php
$visitor_id = $visitor_details['id'];
$file_directory = CONFIG_PROJECT_DOMAIN . '/' . CONFIG_PROJECT_DIR_NAME . '/uploads/visitor/';
?>
<!--<aside class="profile-nav col-lg-3">
    <section class="panel">
        <div class="user-heading round">
            <a href="#">
                <img alt="" src="<?//= (isset($visitor_details['image']) && !empty($visitor_details['image']) && ($visitor_details['image'] !== 'null') ? $file_directory . $visitor_details['image'] : AUTH_ASSETS . '/img/user_default.png') ?> ">
            </a>
        </div>
    </section>

    moderator form 
</aside>-->

<!-- Creates the bootstrap modal where the image will appear -->
<div class="col-lg-12">
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:1000px;height:500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Visitor Profile</h4>
                </div>
                <div class="modal-body">
                    <img src="" id="imagepreview" height="500" width="970">
                </div>
            </div>
        </div>
    </div>
</div>
<aside class="col-lg-3">
    <section class="panel" pop>
        <div class="user-heading">
            <a href="#" id="pop">
                <img id="imageresource" src="<?= (isset($visitor_details['image']) && !empty($visitor_details['image']) && ($visitor_details['image'] !== 'null') ? $file_directory . $visitor_details['image'] : AUTH_ASSETS . '/img/user_default.png') ?>" class="img-thumbnail" alt="Cinque Terre" width="100%" style="height:192px;">
            </a>
        </div>
    </section>
</aside>

<aside class="profile-info col-lg-9">
    <a href="<?= base_url(INDEX_PHP . 'admin-panel/visitor-list') ?>"><button class="btn-success btn-xs btn pull-right" style="margin: 1%;">Back to visitor list</button></a>
    <section class="panel">
        <div class="panel-body bio-graph-info">
            <h1>Visitor Details</h1>
            <div class="row">
                <div class="bio-row">
                    <p><span>Name </span>: <?= $visitor_details['name'] ?></p>
                </div>
                <div class="bio-row">
                    <p><span>Mobile</span>: <?= $visitor_details['mobile'] ?></p>
                </div>
                <div class="bio-row">
                    <p><span>Arogya Setu Status</span>: <?= (($visitor_details['arogya_setu_status'] == 0) ? "Not Verified" : (($visitor_details['arogya_setu_status'] == 1) ? "Safe" : (($visitor_details['arogya_setu_status'] == 2) ? "Unsafe" : "N/A"))) ?></p>
                </div>
                <div class="bio-row">
                    <p><span>Registered At </span>: <?php echo date("d-m-Y H:i:s", $visitor_details['creation_time'] / 1000) ?></p>
                </div>
                <div class="bio-row">
                    <p><span>Address</span>: <?= $visitor_details['address'] ?></p>
                </div>
            </div>
        </div>		  
    </section>
</aside>


<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">
            <?php //echo strtoupper($page); ?> Visitor(s) Record List
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <table  class="display table table-bordered table-striped" id="all-video-grid">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>To Whome</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th></th>
                            <th><input type="text" data-column="1"  class="search-input-text form-control"></th>
                            <th></th>
                            <th></th>
                            <th></th>         
                        </tr>
                    </thead>
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
                            "pageLength": 15,
                            "lengthMenu": [[15, 25, 50], [15, 25, 50]],
                           "serverSide": true,
                           "order": [[ 0, "desc" ]],
                           "ajax":{
                               url :"$adminurl"+"visitor_management/visitor_management/ajax_visitor_details/?visitor_id=$visitor_id", // json datasource
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
				   
				   $('#min-date-video-list').datepicker({
				  		format: 'dd-mm-yyyy',
						autoclose: true
						
					});
					$('#max-date-video-list').datepicker({
						format: 'dd-mm-yyyy',
						autoclose: true
						
					});
               </script>
        
               <script>
//            $("#pop").on("mouseover", function() {
        $("#pop").on("click", function() {
                $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
                $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
             });
	 </script>

EOD;

echo modules::run('auth_panel/template/add_custum_js', $custum_js);
?>
