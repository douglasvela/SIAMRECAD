<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/logo.ico">
    <title>Registrarme - Pago de viáticos</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/wizard/steps.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url(); ?>/assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Barra Superior -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-light">
            <!-- ============================================================== -->
            <!-- Content -->
            <!-- ============================================================== -->
            <div class="navbar-header" align="center">
                <li style="margin-left: 10px;" class="navbar-brand text-white" href="index.html"><b><i class="icon-user-follow"></i> &emsp;Registrar nuevo usuario</b></li>
            </div>
            <!-- ============================================================== -->
            <!-- End Content -->
            <!-- ============================================================== -->
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Barra Superior -->
    <!-- ============================================================== --> 

    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Validation wizard -->
    <div class="row" style="padding-top: 20px; background-image:url(<?php echo base_url(); ?>assets/images/portadas/viaticos2.jpg); background-size: cover;">
    	<div class="col-lg-2"></div>
    	<div class="col-lg-8">
		    


    		<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <h4 class="card-title">Step wizard</h4>
                                <h6 class="card-subtitle">You can find the <a href="http://www.jquery-steps.com" target="_blank">offical website</a></h6>
                                <form action="#" class="tab-wizard wizard-circle">
                                    <!-- Step 1 -->
                                    <h6>Personal Info</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstName1">First Name :</label>
                                                    <input type="text" class="form-control" id="firstName1"> </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lastName1">Last Name :</label>
                                                    <input type="text" class="form-control" id="lastName1"> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="emailAddress1">Email Address :</label>
                                                    <input type="email" class="form-control" id="emailAddress1"> </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phoneNumber1">Phone Number :</label>
                                                    <input type="tel" class="form-control" id="phoneNumber1"> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="location1">Select City :</label>
                                                    <select class="custom-select form-control" id="location1" name="location">
                                                        <option value="">Select City</option>
                                                        <option value="Amsterdam">India</option>
                                                        <option value="Berlin">USA</option>
                                                        <option value="Frankfurt">Dubai</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="date1">Date of Birth :</label>
                                                    <input type="date" class="form-control" id="date1"> </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 2 -->
                                    <h6>Job Status</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jobTitle1">Job Title :</label>
                                                    <input type="text" class="form-control" id="jobTitle1"> </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="videoUrl1">Company Name :</label>
                                                    <input type="text" class="form-control" id="videoUrl1">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="shortDescription1">Job Description :</label>
                                                    <textarea name="shortDescription" id="shortDescription1" rows="6" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 3 -->
                                    <h6>Interview</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="int1">Interview For :</label>
                                                    <input type="text" class="form-control" id="int1"> </div>
                                                <div class="form-group">
                                                    <label for="intType1">Interview Type :</label>
                                                    <select class="custom-select form-control" id="intType1" data-placeholder="Type to search cities" name="intType1">
                                                        <option value="Banquet">Normal</option>
                                                        <option value="Fund Raiser">Difficult</option>
                                                        <option value="Dinner Party">Hard</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Location1">Location :</label>
                                                    <select class="custom-select form-control" id="Location1" name="location">
                                                        <option value="">Select City</option>
                                                        <option value="India">India</option>
                                                        <option value="USA">USA</option>
                                                        <option value="Dubai">Dubai</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jobTitle2">Interview Date :</label>
                                                    <input type="date" class="form-control" id="jobTitle2">
                                                </div>
                                                <div class="form-group">
                                                    <label>Requirements :</label>
                                                    <div class="c-inputs-stacked">
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">Employee</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">Contract</span> </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 4 -->
                                    <h6>Remark</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Behaviour :</label>
                                                    <input type="text" class="form-control" id="behName1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="participants1">Confidance</label>
                                                    <input type="text" class="form-control" id="participants1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="participants1">Result</label>
                                                    <select class="custom-select form-control" id="participants1" name="location">
                                                        <option value="">Select Result</option>
                                                        <option value="Selected">Selected</option>
                                                        <option value="Rejected">Rejected</option>
                                                        <option value="Call Second-time">Call Second-time</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="decisions1">Comments</label>
                                                    <textarea name="decisions" id="decisions1" rows="4" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Rate Interviwer :</label>
                                                    <div class="c-inputs-stacked">
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">1 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">2 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">3 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">4 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">5 star</span> </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    		

		    <div class="row" id="validation">
		        <div class="col-12">
		            <div class="card wizard-content">
		                <div class="card-body">
		                    <h4 class="card-title">Completa el siguiente formulario</h4>
		                    <form action="#" class="validation-wizard wizard-circle">
		                        <!-- Step 1 -->
		                        <h6>Paso 1</h6>
		                        <section>
		                            <div class="row">
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="wfirstName2"> Nombre : <span class="danger">*</span> </label>
		                                        <input type="text" class="form-control required" id="wfirstName2" name="firstName"> </div>
		                                </div>
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="wlastName2"> Apellido : <span class="danger">*</span> </label>
		                                        <input type="text" class="form-control required" id="wlastName2" name="lastName"> </div>
		                                </div>
		                            </div>
		                            <div class="row">
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="wemailAddress2"> Email : <span class="danger">*</span> </label>
		                                        <input type="email" class="form-control required" id="wemailAddress2" name="emailAddress"> </div>
		                                </div>
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="wphoneNumber2"> Teléfono :</label>
		                                        <input type="tel" class="form-control" id="wphoneNumber2"> </div>
		                                </div>
		                            </div>
		                            <div class="row">
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="wlocation2"> Ciudad : <span class="danger">*</span> </label>
		                                        <select class="custom-select form-control required" id="wlocation2" name="location">
		                                            <option value="">Select City</option>
		                                            <option value="India">India</option>
		                                            <option value="USA">USA</option>
		                                            <option value="Dubai">Dubai</option>
		                                        </select>
		                                    </div>
		                                </div>
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="wdate2">Fecha nacimiento :</label>
		                                        <input type="date" class="form-control" id="wdate2"> </div>
		                                </div>
		                            </div>
		                        </section>
		                        <!-- Step 2 -->
		                        <h6>Paso 2</h6>
		                        <section>
		                            <div class="row">
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="jobTitle2">Company Name :</label>
		                                        <input type="text" class="form-control required" id="jobTitle2">
		                                    </div>
		                                </div>
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="webUrl3">Company URL :</label>
		                                        <input type="url" class="form-control required" id="webUrl3" name="webUrl3"> </div>
		                                </div>
		                                <div class="col-md-12">
		                                    <div class="form-group">
		                                        <label for="shortDescription3">Short Description :</label>
		                                        <textarea name="shortDescription" id="shortDescription3" rows="6" class="form-control"></textarea>
		                                    </div>
		                                </div>
		                            </div>
		                        </section>
		                        <!-- Step 3 -->
		                        <h6>Paso 3</h6>
		                        <section>
		                            <div class="row">
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="wint1">Interview For :</label>
		                                        <input type="text" class="form-control required" id="wint1"> </div>
		                                    <div class="form-group">
		                                        <label for="wintType1">Interview Type :</label>
		                                        <select class="custom-select form-control required" id="wintType1" data-placeholder="Type to search cities" name="wintType1">
		                                            <option value="Banquet">Normal</option>
		                                            <option value="Fund Raiser">Difficult</option>
		                                            <option value="Dinner Party">Hard</option>
		                                        </select>
		                                    </div>
		                                    <div class="form-group">
		                                        <label for="wLocation1">Location :</label>
		                                        <select class="custom-select form-control required" id="wLocation1" name="wlocation">
		                                            <option value="">Select City</option>
		                                            <option value="India">India</option>
		                                            <option value="USA">USA</option>
		                                            <option value="Dubai">Dubai</option>
		                                        </select>
		                                    </div>
		                                </div>
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="wjobTitle2">Interview Date :</label>
		                                        <input type="date" class="form-control required" id="wjobTitle2">
		                                    </div>
		                                    <div class="form-group">
		                                        <label>Requirements :</label>
		                                        <div class="c-inputs-stacked">
		                                            <label class="inline custom-control custom-checkbox block">
		                                                <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">Employee</span> </label>
		                                            <label class="inline custom-control custom-checkbox block">
		                                                <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">Contract</span> </label>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </section>
		                        <!-- Step 4 -->
		                        <h6>Paso 4</h6>
		                        <section>
		                            <div class="row">
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="behName1">Behaviour :</label>
		                                        <input type="text" class="form-control required" id="behName1">
		                                    </div>
		                                    <div class="form-group">
		                                        <label for="participants1">Confidance</label>
		                                        <input type="text" class="form-control required" id="participants1">
		                                    </div>
		                                    <div class="form-group">
		                                        <label for="participants1">Result</label>
		                                        <select class="custom-select form-control required" id="participants1" name="location">
		                                            <option value="">Select Result</option>
		                                            <option value="Selected">Selected</option>
		                                            <option value="Rejected">Rejected</option>
		                                            <option value="Call Second-time">Call Second-time</option>
		                                        </select>
		                                    </div>
		                                </div>
		                                <div class="col-md-6">
		                                    <div class="form-group">
		                                        <label for="decisions1">Comments</label>
		                                        <textarea name="decisions" id="decisions1" rows="4" class="form-control"></textarea>
		                                    </div>
		                                    <div class="form-group">
		                                        <label>Rate Interviwer :</label>
		                                        <div class="c-inputs-stacked">
		                                            <label class="inline custom-control custom-checkbox block">
		                                                <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">1 star</span> </label>
		                                            <label class="inline custom-control custom-checkbox block">
		                                                <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">2 star</span> </label>
		                                            <label class="inline custom-control custom-checkbox block">
		                                                <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">3 star</span> </label>
		                                            <label class="inline custom-control custom-checkbox block">
		                                                <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">4 star</span> </label>
		                                            <label class="inline custom-control custom-checkbox block">
		                                                <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">5 star</span> </label>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </section>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<div class="col-lg-2"></div>
	</div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
