<?php
$sysmsg['ip_blocked'] = '<div id="msgbox" class="alert alert-info"><strong><i class="fa fa-info-circle"></i> Sorry!!!</strong> No records found in this section to display.</div>';
$sysmsg['no_profiles'] = '<div id="msgbox" class="alert alert-info"><strong><i class="fa fa-info-circle"></i> Sorry!!!</strong> No records found in this section to display.</div>';
$sysmsg['no_access'] = '<div id="msgbox" class="alert alert-danger"> <i class="fa fa-exclamation-circle fa-2 fa-fw" aria-hidden="true"></i> <strong>Sorry!!!</strong><br>You are not authorised to Access this section. <br /><br /></div>';
$sysmsg['submit_duplicate_error'] = 'Error!!! Record already Exists. Unable to add this new record as a similar record already exists.';
$sysmsg['update_info_success'] = '<div id="msgbox" class="alert alert-success"> <i class="fa fa-check-square-o fa-fw" aria-hidden="true"></i> <strong>Add/Update Successful!!!</strong> The Record has been updated successfully.</div>';
$sysmsg['update_error'] = '<div id="msgbox" class="alert alert-danger"> <i class="fa fa-exclamation-circle fa-2 fa-fw" aria-hidden="true"></i> <strong>Error!!!</strong>Could not Add/Update. Please try again. <br /><br /><a href="javascript:history.go(-1)"><img src="images/button_back.gif" alt="Back" border=0 align="absmiddle"><strong> Back</strong></a><br><br></div>';
$sysmsg['no_data'] = '<div class="col-md-12 m-t-xs"><div class="alert alert-danger"><h1 class="text-center"><i class="fa fa-frown-o" aria-hidden="true"></i><strong>The requested Data could not be found.</strong></h1></div></div>';
$sysmsg['invalid-user'] = '<div class="col-md-12 m-t-xs m-b-n"><div id="msgbox" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><p class="text  text-center"><strong>Sorry!!!</strong><br>Unable to Log you in. The Username or the Password do not match. <br> Please try again with the proper Username and Password.<br></p></div>    </div>';
$sysmsg['invalid-captcha'] = '<div class="col-md-12 m-t-xs m-b-n"><div id="msgbox" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><p class="text  text-center"><strong>Captcha Error!!!</strong><br>The Captcha Verification Failed. Please try again.<br></p></div>    </div>';
$sysmsg['loging_in'] = '<div class="col-md-4 col-md-offset-4"><div class="cssProgress"><span>Please wait while you’re redirected..</span><div class="progress1"><div class="cssProgress-bar cssProgress-active" style="transition: none;width: 100%;"> <span class="cssProgress-label">&nbsp;</span> </div></div></div></div>';
$sysmsg['submit_error'] = '<div class="col-md-12 m-t-xs m-b-n"><div id="msgbox" class="alert alert-danger alert-dismissable"><i class="fa fa-exclamation-circle fa-2 fa-fw" aria-hidden="true"></i> Compulsury Fileds are not Filled up. Please make the necessary inputs</div>    </div>';
$sysmsg['upload_success'] = '<div class="alert alert-success" name="msgbox" id="msgbox"><i class="fa fa-check-square-o fa-fw" aria-hidden="true"></i><strong>Upload Successful!</strong>The File has been succesfully uploaded.</div>';
$sysmsg['upload_error'] = '<div class="alert alert-danger" name="msgbox" id="msgbox"><p><strong>Error!</strong>Could Not Upload. Please Contact Admin for assistance or Try again.</p></div>';
$sysmsg['upload_ext_error'] = '<div class="alert alert-danger" name="msgbox" id="msgbox"><p><strong>Error!</strong>The File Extension is not supported. Please upload files of supported File Types only.</p></div>';
$sysmsg['upload_size_error'] = '<div class="alert alert-danger" name="msgbox" id="msgbox" ><p><strong>Error!</strong>The File Size is bigger than that maximum allowed File Size.</p></div>';
$sysmsg['upload_nofile_error'] = '<div class="alert alert-danger" name="msgbox" id="msgbox"><p><strong>Error!</strong>No Files Specified to upload.  <a href="javascript:history.go(-1)">Back</a></p></div>';
$sysmsg['pagenotfound'] = '<div name="msgbox" id="msgbox" class="uc"><p><strong>Under Construction!</strong> 404 Page Not Found. Please visit us later.</p></div>';
$sysmsg['contact_message_success'] = '<div class="alert alert-success" name="msgbox" id="msgbox"><i class="fa fa-check-square-o fa-fw" aria-hidden="true"></i><strong>Thank you!</strong>Your Message has been sent.</div>';
$sysmsg['email_error'] = '<div class="alert alert-danger" name="msgbox" id="msgbox"><p><strong>Error!</strong>Mail not sent. Please Contact Admin for assistance or Try again.</p></div>';

#Mail Meassage

$sysmsg['contact_mail_body'] = '<font face="Arial" size="2">
<b>The following details have been submitted from the contact us form of your website</b>
<br>
<br>
1) <b>Name</b> : {NAME}
<br>
2) <b>Email</b> : {EMAIL}
<br>
3) <b>Message</b> : {MESSAGE}
<br>
4) <b>Mobile</b> : {MOBILE}
<br>
5) <b>Page Link:</b> <a href="{PAGE}">{PAGE}</a>
<br>
<br>
<i>Note: Please click on "<b>Reply</b>" to reply/contact this email/sender.</i>
</font>
';

$sysmsg['package_mail_body'] = '<font face="Arial" size="2">
<b>The following details have been submitted from the contact us form of your website</b>
<br>
<br>
1) <b>Name</b> : {NAME}
<br>
2) <b>Email</b> : {EMAIL}
<br>
3) <b>Message</b> : {MESSAGE}
<br>
4) <b>Mobile</b> : {MOBILE}
<br>
5) <b>Page Link:</b> <a href="{PAGE}">{PAGE}</a>
<br>
6) <b>Date</b> : {DATE}
<br>
7) <b>Adult</b> : {ADULT}
<br>
8) <b>CHILD</b> : {CHILD}
<br>
<br>
<i>Note: Please click on "<b>Reply</b>" to reply/contact this email/sender.</i>
</font>
';
?>