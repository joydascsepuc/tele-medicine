<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Pages/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Pages Controller
$route['home'] = 'pages/index';
$route['signin'] = 'pages/login';
$route['dashboard'] = 'pages/home';
$route['select'] = 'pages/selection';
$route['type'] = 'pages/registerType';
$route['patientregister'] = 'pages/registrationPatient';
$route['doctorregister'] = 'pages/registrationDoctor';
$route['forgot'] = 'pages/forgot';
$route['profile'] = 'pages/profile';
$route['signout'] = 'pages/logout';
$route['passcheck'] = 'pages/currentPassCheck';
$route['doctorphone'] = 'pages/fetchDoctorPhone';
$route['patientphone'] = 'pages/fetchPatientPhone';


//Doctor Controller
$route['dochome'] = 'doctors/dash';
$route['doctorappointment'] = 'doctors/fetchAppointmentList';
$route['docappoinmentdetails/(:any)'] = 'doctors/appoinmentdetails/$1';
$route['toggle'] = 'doctors/toggleDoctorAvailablity';


//Medicine Controller
$route['medihome'] = 'medicines/index';
$route['newmedicine'] = 'medicines/create';
$route['editmedicine/(:any)'] = 'medicines/update/$1';
$route['rmvmedicine'] = 'medicines/remove';
$route['fetchmedicine'] = 'medicines/fetchMedicineData';
$route['fetchmedicinebyid/(:any)'] = 'medicines/fetchMedicineDataById/$1';


//Patient Controller
$route['patienthome'] = 'patient/home';
$route['takeappointment'] = 'patient/takeappointment';
$route['doctoronline/(:any)'] = 'patient/doctorOnline/$1';
$route['placeserial/(:any)/(:any)'] = 'patient/placeserial/$1/$2';
$route['patientappointment'] = 'patient/fetchAppointmentList';
$route['patappoinmentdetails/(:any)'] = 'patient/appoinmentdetails/$1';
$route['pdfprescription/(:any)'] = 'patient/pdfPrescription/$1';




//Department Controller
$route['department'] = 'departments/index';
$route['newdepartment'] = 'departments/create';
$route['editdepartment/(:any)'] = 'departments/update/$1';
$route['rmvdepartment'] = 'departments/remove';
$route['priority'] = 'departments/getDepartmentPriority';
$route['departments'] = 'departments/fetchDepartmentData';
$route['priorityid/(:any)'] = 'departments/fetchDepartmentDataById/$1';



//Notice Controller
$route['notice'] = 'notices/index';
$route['newnotice'] = 'notices/create';
$route['editnotice/(:any)'] = 'notices/update/$1';
$route['rmvnotice'] = 'notices/remove';
$route['notices'] = 'notices/fetchNoticeData';
$route['noticeid/(:any)'] = 'notices/fetchNoticeDataById/$1';




//Slider Controller
$route['slider'] = 'slider/index';
$route['newslider'] = 'slider/create';
$route['editslider/(:any)'] = 'slider/update/$1';
$route['rmvslider'] = 'slider/remove';
$route['sliders'] = 'slider/fetchSliderData';
$route['sliderid/(:any)'] = 'slider/fetchSliderDataById/$1';



//Diesease Controller
$route['diseasehome'] = 'disease/index';
$route['newdisease'] = 'disease/create';
$route['editdisease/(:any)'] = 'disease/edit/$1';
$route['rmvdisease'] = 'disease/remove';
$route['fetchdisease'] = 'disease/fetchDiseaseData';
$route['savemedicine'] = 'disease/newMedicine';
$route['findmedicine'] = 'disease/fetchMedicine';
$route['searchdoses'] = 'disease/fetchDosesForSearch';
$route['finddoses'] = 'disease/fetchDoses';
$route['searchinstruction'] = 'disease/fetchInstructionForSearch';
$route['findinstruction'] = 'disease/fetchInstructions';
$route['searchday'] = 'disease/fetchDayForSearch';
$route['findday'] = 'disease/fetchDays';
$route['searchamount'] = 'disease/fetchAmountForSearch';
$route['findamount'] = 'disease/fetchAmount';
$route['cartmedicine'] = 'disease/raw_add_item';
$route['cartmedicinedelete/(:any)'] = 'disease/in_delete_item/$1';
$route['cartmedicineedit/(:any)'] = 'disease/in_edit_item/$1';
$route['searchdisease'] = 'doctors/fetchDiseaseForSearch';
$route['finddisease'] = 'doctors/fetchDisease';
$route['finddiseasemedicine'] = 'doctors/fetchDiseaseMedicine';
$route['searchcomplaint'] = 'disease/fetchComplaintForAutocomplete';
$route['searchexamination'] = 'disease/fetchExaminationForAutocomplete';
$route['searchdiagnosis'] = 'disease/fetchDiagnosisForAutocomplete';
$route['searchinvestigation'] = 'disease/fetchInvestigationForAutocomplete';
$route['searchadvice'] = 'disease/fetchAdviceForAutocomplete';
$route['searchmedicine'] = 'disease/fetchMedicineForAutocomplete';



//Users Controller
$route['users'] = 'users/index';
$route['rmvuser/(:any)'] = 'users/delete/$1';
$route['passreset/(:any)'] = 'users/delete/$1';



//Groups Controller
$route['groups'] = 'groups/index';
$route['newgroups'] = 'groups/create';
$route['editgroups/(:any)'] = 'groups/edit/$1';
$route['rmvgroups/(:any)'] = 'groups/remove/$1';


//Chat Controller
$route['chathistory/(:any)'] = 'chat/fetchChatHistory/$1';
$route['sendtext'] = 'chat/send_text_message';
$route['chat/(:any)'] = 'chat/index/$1';
$route['prescribe'] = 'chat/prescribe';


// Company Controller
$route['company'] = 'company/index';









