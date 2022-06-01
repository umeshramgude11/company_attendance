<?php

// use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\DB;
// echo "<pre>";print_r(Session::get('attendance_session'));
// function DT_RenderColumns($aColumns) {

// 	/* Paging */
// 	$dtLimit = "";
// 	if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
// 		$dtLimit = "LIMIT " . stripslashes($_GET['iDisplayStart']) . ", " .
// 		                stripslashes($_GET['iDisplayLength']);
// 	}
// 	$data['dtLimit'] = $dtLimit;


// 	/* Ordering */
// 	$dtOrder = '';
// 	if (isset($_GET['iSortCol_0'])) {
// 		$dtOrder = "ORDER BY  ";
// 		for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
// 			if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
// 				$dtOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . "
// 				 	" . stripslashes($_GET['sSortDir_' . $i]) . ", ";
// 			}
// 		}

// 		$dtOrder = substr_replace($dtOrder, "", -2);
// 		if ($dtOrder == "ORDER BY") {
// 			$dtOrder = "";
// 		}
// 	}
// 	$data['dtOrder'] = $dtOrder;


// 	/*
// 	* Filtering
// 	     * NOTE this does not match the built-in DataTables filtering which does it
// 	     * word by word on any field. It's possible to do here, but concerned about efficiency
//      * on very large tables, and MySQL's regex functionality is very limited
// 	     */
// 	    $dtWhere = "";
// 	if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
// 		$dtWhere = "WHERE (";
// 		for ($i = 0; $i < count($aColumns); $i++) {
// 			if (trim($aColumns[$i]) != '') {
// 				$dtWhere .= $aColumns[$i] . " LIKE '%" . stripslashes($_GET['sSearch']) . "%' OR ";
// 			}
// 		}
// 		$dtWhere = substr_replace($dtWhere, "", -3);
// 		$dtWhere .= ')';
// 	}


// 	/* Individual column filtering */
// 	for ($i = 0; $i < count($aColumns); $i++) {
// 		if (trim($aColumns[$i]) != '') {
// 			if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
// 				if ($dtWhere == "") {
// 					$dtWhere = "WHERE ";
// 				}
// 				else {
// 					$dtWhere .= " AND ";
// 				}
// 				$dtWhere .= $aColumns[$i] . " LIKE '%" . stripslashes($_GET['sSearch_' . $i]) . "%' ";
// 			}
// 		}
// 	}
// 	$data['dtWhere'] = $dtWhere;
// 	return $data;
// }
// function UserAvatar($user_id){
// 	$CI = & get_instance();
// 	$LcSqlStr = "SELECT avatar FROM users WHERE status=1 and userid=".$user_id;
// 	$query = $CI->db->query($LcSqlStr);
// 	$ResultSet = $query->row();
// 	if (count($ResultSet) > 0){
// 		return base_url().$ResultSet->avatar;
// 	}else{
// 		return base_url()."assets/layouts/layout/img/avatar.png";
// 	}
// }
// function CheckRights($user_id = '', $menu = '', $Mode = '') {

// 	$apps_session = session('attendance_session');
// 	$superaccess  = $apps_session['superaccess'];

// 	if ($superaccess == true) {
// 		$ResultSet = array(
// 		            'role'         => 1,
// 		            'allow_access' => 1,
// 		            'allow_add'    => 1,
// 		            'allow_view'   => 1,
// 		            'allow_edit'   => 1,
// 		            'allow_delete' => 1,
// 		            'allow_print'  => 1,
// 		            'allow_import' => 1,
// 		            'allow_export' => 1);
// 		return (object) $ResultSet;
// 	}
// 	else {

// 		$ResultSet = DB::select(" SELECT b.roleid,if(sum(a.allow_access)> 0,1,0) as allow_access,if(sum(a.allow_add)> 0,1,0) as allow_add,if(sum(a.allow_view)> 0,1,0) as allow_view ,if(sum(a.allow_edit)> 0,1,0) as allow_edit,
// 		if(sum(a.allow_delete)> 0,1,0) as allow_delete,if(sum(a.allow_print)> 0,1,0) as allow_print,if(sum(a.allow_import)> 0,1,0) as allow_import,if(sum(a.allow_export)> 0,1,0)as allow_export FROM
// 		access_role_modules a LEFT JOIN usersrole b ON a.roleid =b.roleid "
//                           . " LEFT JOIN access_modules c ON a.moduleid=c.moduleid  WHERE c.status=1 and c.modulename='" . $menu . "' AND b.userid=" . $user_id);

// 		if ($Mode <> '') {
//                     if(count($ResultSet) > 0){
//                         foreach ($ResultSet as $rs){
//                             if ($rs->$Mode > 0) {
//                                 return true;
//                             }
//                             else {
//                                 return false;
//                             }
//                         }
//                     }
// 		}
// 		else {
//                     return $ResultSet;
// 		}
// 	}
// }

// function auto_email($AlertName, $Patterns, $Replacements, $Id, $Type) {
// 	$CI = & get_instance();

// 	if ($Type == 'F') {
// 		$CustomerInfo = $CI->common_model->getCustomerInfo($Id);
// 		$To = $CustomerInfo->email;
// 		$Toname = $CustomerInfo->firstname . ' ' . $CustomerInfo->lastname;
// 	}
// 	else {

// 	}


// 	$EmailTemplate = $CI->common_model->email($AlertName);
// 	$Fromname = $EmailTemplate->fromname;
// 	$From = $EmailTemplate->fromemail;
// 	$Subject = $EmailTemplate->subject;
// 	$Message = $EmailTemplate->message;

// 	$SMTP = $CI->common_model->smtp();
// 	$SMTPHost = $SMTP->hostname;
// 	$SMTPAuth = $SMTP->smtpauth;
// 	$SMTPUsername = $SMTP->username;
// 	$SMTPPassword = $SMTP->password;
// 	$SMTPSecure = $SMTP->smtpsecure;
// 	$SMTPPort = $SMTP->port;

// 	$Body = preg_replace($Patterns, $Replacements, $Message);

// 	$CI->load->library('My_PHPMailer');
// 	$mail = new PHPMailer;
// 	$mail->SMTPDebug = 0;
// 	$mail->isSMTP();
// 	$mail->Host = $SMTPHost;
// 	$mail->SMTPAuth = $SMTPAuth;
// 	$mail->Username = $SMTPUsername;
// 	$mail->Password = $SMTPPassword;
// 	$mail->SMTPSecure = $SMTPSecure;
// 	$mail->XMailer = ' ';

// 	$mail->setFrom($From, $Fromname);
// 	$mail->addAddress($To, $Toname);

// 	$mail->isHTML(true);
// 	$mail->SMTPKeepAlive = true;
// 	$mail->CharSet = 'UTF-8';
// 	$mail->Subject = $Subject;
// 	$mail->Body = $Body;
// 	$mail->AltBody = $Subject;
// 	$mail->Mailer = "smtp";

// 	$Flag = $mail->send();

// 	$now = date('Y-m-d H:i:s');
// 	$EmailData = array(
// 	        'custid' => $Id,
// 	        'eto' => $To,
// 	        'subject' => $Subject,
// 	        'body' => $Body,
// 	        'status' => $Flag,
// 	        'addeddate' => $now);
// 	$CI->common_model->insert('emaillog', $EmailData);

// 	return $Flag;
// }
// function get_category(){
//     $CI = & get_instance();
//    $categories = $CI->common_model->get_category();
//  return $categories;
//  }
//  function get_subcategory($category_id){
//     $CI = & get_instance();
//    $categories = $CI->common_model->get_subcategory($category_id);
//  return $categories;
//  }
//  function get_latestcontent($cat_id,$subcategory_id){
//     $CI = & get_instance();
//    $categories = $CI->common_model->get_latestcontent($cat_id,$subcategory_id);
//  return $categories;
//  }
//  function get_contentList($cat_id,$Limit=3){
//     $CI = & get_instance();
//    $data = $CI->common_model->get_contentdetails($cat_id,$Limit);
//  return $data;
//  }
