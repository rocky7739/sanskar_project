<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Mosaddek">
		<meta https-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="shortcut icon" href="<?php echo base_url('assets/website_assets/images/favicon.ico'); ?>">

		<title><?= CONFIG_PROJECT_FULL_NAME ?> ADMIN </title>

    	<link rel="stylesheet" type="text/css" href="<?php echo AUTH_ASSETS; ?>assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
		<!-- Bootstrap core CSS -->
		<link href="<?php echo AUTH_ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">
                <link href="<?php echo AUTH_ASSETS; ?>css/timedropper.css" rel="stylesheet">
		<link href="<?php echo AUTH_ASSETS; ?>css/bootstrap-reset.css" rel="stylesheet">
		<!--external css-->
		<link href="<?php echo AUTH_ASSETS; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

		<link href="<?php echo AUTH_ASSETS; ?>assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
	    <link rel="stylesheet" type="text/css" href="<?php echo AUTH_ASSETS; ?>css/gallery.css" />
		<!--right slidebar-->
		<link href="<?php echo AUTH_ASSETS ?>css/slidebars.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="<?php echo AUTH_ASSETS; ?>css/style.css" rel="stylesheet">
		<link href="<?php echo AUTH_ASSETS; ?>css/style-responsive.css" rel="stylesheet" />



		 <link  rel="stylesheet" href="<?php echo AUTH_ASSETS; ?>assets/bootstrap-datepicker/css/datepicker.css">

		<!-- date time picker css -->
		 <link rel="stylesheet" type="text/css" href="<?php echo AUTH_ASSETS; ?>assets/bootstrap-datetimepicker/css/datetimepicker.css" />

		<!-- file upload css -->
		<link rel="stylesheet" type="text/css" href="<?php echo AUTH_ASSETS; ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />


		<!-- Time picker css -->
		<link rel="stylesheet" type="text/css" href="<?php echo AUTH_ASSETS; ?>assets/bootstrap-timepicker/compiled/timepicker.css" />

		<!--toastr-->
		<link href="<?php echo AUTH_ASSETS; ?>assets/toastr-master/toastr.css" rel="stylesheet" type="text/css" />

		<!--dynamic table-->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	</head>

	<body>

		<section id="container" class="">
			<!--header start-->
			<header class="header white-bg">
				<div class="sidebar-toggle-box">
					<div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
				</div>
				<!--logo start-->
				<a href="" class="logo" ><?=CONFIG_PROJECT_FULL_NAME?><span> <?=CONFIG_PROJECT_SUBDOMAIN_NAME?> ADMIN</span></a>
				<!--logo end-->
				<div class="nav notify-row" id="top_menu">
				</div>
				<div class="top-nav ">
					<ul class="nav pull-right top-menu">
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class ="fa fa-user"></i>
								<span class="username">ACCOUNT</span>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu extended logout">
								<div class="log-arrow-up"></div>
								<li><a class="  hide"  href="#"><i class=" fa fa-suitcase hide"></i>Profile</a></li>
								<li><a  class="  hide"  href="#"><i class="fa fa-cog hide"></i> Settings</a></li>
								<li><a  class=""  href="#"><i class="fa fa-bell-o hide "></i>
										<?php
$user_data = $this->session->userdata('active_user_data');
echo 'login user name:  ' . $user_data->username . '</br> login email:  ' . $user_data->email;
?>
									</a></li>
								<li><a href="<?php echo site_url('auth_panel/login/logout'); ?>"><i class="fa fa-key"></i> Log Out</a></li>
							</ul>
						</li>

						<!-- user login dropdown end -->
					</ul>
				</div>
			</header>
			<!--header end-->
			<!--sidebar start-->
			<?php
$this->load->view('SIDEBAR_SUPER_USER');
?>

			<!--sidebar end-->
			<!--main content start-->
			<section id="main-content">
				<section class="wrapper site-min-height">
					<div class="row">
						<div class="col-lg-12 hide">
							<ul class="breadcrumb">
								<li class="active capitalize"><?php echo isset($page_title) ? $page_title : ""; ?></li>
							</ul>
						</div>
						<div class="col-lg-12">
							<?php echo isset($page_data) ? $page_data : ""; ?>
						</div>

					</div>
				</section>
			</section>
			<!--main content end-->

			<!--footer start-->
			<footer class="site-footer">
				<div class="text-center">
					<?=CONFIG_PROJECT_FULL_NAME?> BACKEND
					<a href="#" class="go-top">
						<i class="fa fa-angle-up"></i>
					</a>
				</div>
			</footer>
			<!--footer end-->
		</section>

		<!-- js placed at the end of the document so the pages load faster -->
		<script src="<?php echo AUTH_ASSETS; ?>js/jquery.js"></script>
                <script src="<?php echo AUTH_ASSETS; ?>js/popper.min.js"></script>
		<script src="<?php echo AUTH_ASSETS; ?>js/bootstrap.min.js"></script>
                <script src="<?php echo AUTH_ASSETS; ?>js/timedropper.js"></script>
		<script class="include" type="text/javascript" src="<?php echo AUTH_ASSETS; ?>js/jquery.dcjqaccordion.2.7.js"></script>
    	<script src="<?php echo AUTH_ASSETS; ?>assets/fancybox/source/jquery.fancybox.js"></script>
		<script src="<?php echo AUTH_ASSETS; ?>js/jquery.scrollTo.min.js"></script>
		<script src="<?php echo AUTH_ASSETS; ?>js/slidebars.min.js"></script>
		<script src="<?php echo AUTH_ASSETS; ?>js/jquery.nicescroll.js" type="text/javascript"></script>
		<script src="<?php echo AUTH_ASSETS; ?>js/respond.min.js" ></script>
		<script src="<?php echo AUTH_ASSETS; ?>js/modernizr.custom.js"></script>
   		 <script src="<?php echo AUTH_ASSETS; ?>js/toucheffects.js"></script>
		<!-- file upload button -->
		<script type="text/javascript" src="<?php echo AUTH_ASSETS; ?>assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
		<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<!-- Date time  picker -->
		<script type="text/javascript" src="<?php echo AUTH_ASSETS; ?>assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>

		<!--toastr-->
		<script src="<?php echo AUTH_ASSETS; ?>assets/toastr-master/toastr.js"></script>

		<!--common script for all pages-->
		<script src="<?php echo AUTH_ASSETS; ?>js/common-scripts.js"></script>

		<!--date picker-------->
		<script type="text/javascript" src="<?php echo AUTH_ASSETS; ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<!--time picker-------->
		<script type="text/javascript" src="<?php echo AUTH_ASSETS; ?>assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

		<!--jquery knob for charts-------->
		<script type="text/javascript" src="<?php echo AUTH_ASSETS; ?>assets/jquery-knob/js/jquery.knob.js"></script>

  <script type="text/javascript" src="<?php echo AUTH_ASSETS; ?>assets/ckeditor/ckeditor.js"></script>
  <!-- <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script> -->

              <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDD_TuINx3k8rZA9ZS9uZOo_xssoBOJLus"></script>


		<!---wyshtml5-->

		  <script type="text/javascript" src="<?php echo AUTH_ASSETS; ?>assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
		  <script type="text/javascript" src="<?php echo AUTH_ASSETS; ?>assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
                  <script src="<?php echo AUTH_ASSETS; ?>js/select2.min.js"></script>
		  <!--end-->
		<?php /* global ajax handler if authentication failure server will return a code and   it will catch that
 *   start here
 */
?>
		<script>
            $(document).ajaxComplete(function (event, xhr, settings) {
                if (xhr.draw) {
                    alert("ALL current AJAX calls have completed");
                }
            });
		</script>

		<?php /* global ajax handler if authentication failure server will return a code and  it will catch that
 *   end here
 */
?>
		<?php echo $javascript; ?>
		<script type="text/javascript">
            var i = -1;
            var toastCount = 0;
            var $toastlast;
            function show_toast(type, text, title) {
                var shortCutFunction = type;
                var msg = text;
                var toastIndex = toastCount++;

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "10000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                if ($('#addBehaviorOnToastClick').prop('checked')) {
                    toastr.options.onclick = function () {
                        alert('You can perform some custom action after a toast goes away');
                    };
                }


                if (!msg) {
                    msg = getMessage();
                }

                $("#toastrOptions").text("Command: toastr["
                        + shortCutFunction
                        + "](\""
                        + msg
                        + (title ? "\", \"" + title : '')
                        + "\")\n\ntoastr.options = "
                        + JSON.stringify(toastr.options, null, 2)
                        );

                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                $toastlast = $toast;
                if ($toast.find('#okBtn').length) {
                    $toast.delegate('#okBtn', 'click', function () {
                        alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                        $toast.remove();
                    });
                }
                if ($toast.find('#surpriseBtn').length) {
                    $toast.delegate('#surpriseBtn', 'click', function () {
                        alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
                    });
                }
            }



            $('#clearlasttoast').click(function () {
                toastr.clear(getLastToast());
            });
            $('#cleartoasts').click(function () {
                toastr.clear();
            });
<?php //$page_toast_type = "error"; $page_toast = "toast"; $page_toast_title = "title";
if ($page_toast_type != "" && $page_toast != "") {
	?>
			    $('#toast-container').css("width","100%");
	            show_toast('<?php echo $page_toast_type; ?>', '<?php echo $page_toast; ?>','<?php echo $page_toast_title; ?>');

	<?php
} elseif (isset($_SESSION['page_alert_box_type']) && isset($_SESSION['page_alert_box_title']) && isset($_SESSION['page_alert_box_message'])) {
	?>
			$('#toast-container').css("width","100%");
	            show_toast('<?php echo $_SESSION['page_alert_box_type']; ?>', '<?php echo $_SESSION['page_alert_box_message']; ?>','<?php echo $_SESSION['page_alert_box_title']; ?>');
		<?php
//setcookie('page_alert_box_type', "", time() , "/");
	//setcookie('page_alert_box_title', "", time() , "/");
	//setcookie('page_alert_box_message', "", time(), "/");
	unset($_SESSION['page_alert_box_type']);
	unset($_SESSION['page_alert_box_title']);
	unset($_SESSION['page_alert_box_message']);
}
?>
		</script>
		<!-- <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
		<script src="<?php echo AUTH_ASSETS; ?>js/tasks.js" type="text/javascript"></script>
	    <script>
	      jQuery(document).ready(function() {
	          TaskList.initTaskWidget();
	      });

	      $(function() {
	          $( "#sortable" ).sortable();
	          $( "#sortable" ).disableSelection();
	      });

	      $(function() {
	          $( "#sortable_topic" ).sortable();
	          $( "#sortable_topic" ).disableSelection();
	      });
	    </script>
	    <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>
	</body>
</html>
