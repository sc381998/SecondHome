<?php
if (!defined('fileIncluded')) {
    exit();
}
date_default_timezone_set('Asia/Kolkata');
$subject = '';
$name = '';
$message = '';
$email = '';
$mobile= '';
?>

<section class="mb-4 container">
    <div class="modal-title">
      <h1 class="text-capitalize text-center text-red m-3">Contact Us</h1>
    </div>
    <hr class="w-50 mx-auto">
    <p class="text-center w-responsive mx-auto mb-5">It would be great to hear from you! If you got any questions.</p>
    <div class="row">
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contactform" name="contactform" action="javascript:void(0)" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-3">
                            <input type="text" id="cname" placeholder="Your name" name="name" value="<?php echo @$name; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-3">
                            <input type="email" id="mail" placeholder="Your email" value="<?php echo @$email; ?>" name="email" class="form-control">
                        </div>
                    </div>
                    </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-3">
                            <input type="number" id="mobile" required value="<?php echo @$mobile; ?>" placeholder="Your mobile no." name="mobile" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-3">
                            <select id="subject" required name="subject" required class="form-control">
                            <option value="<?php echo @$subject; ?>">Select the subject</option>
                                <?php echo $sys->combogen($contactsub, $contactsub, $subject, false); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-3">
                            <textarea type="text" id="message" required value="<?php echo @$message; ?>" placeholder="Your message" name="message" rows="2" class="form-control md-textarea"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">                                    
                        <?php echo $chk->showCaptcha('sagar'); ?>                                    
                    </div>
                </div>
                <div class="text-center text-md-left ">
                    <button class="btn btn-primary mt-3 px-4" name="Submit"  type="submit" onclick="savecontact();">Send</button>
                </div>
            </form>
        </div>
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fa fa-map-marker fa-2x"></i>
                    <p><?php echo $address_array;?></p>
                </li>

                <li><i class="fa fa-phone mt-4 fa-2x"></i>
                    <p><?php echo $contact_array;?></p>
                </li>

                <li><i class="fa fa-envelope mt-4 fa-2x"></i>
                    <p><?php echo $email_array ?></p>
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>

</section>
<script>
    function savecontact() {
        // console.log("sagar");
         $("#contactform").one("submit", function (event) {
            // console.log("sagar");
             event.preventDefault();
            $.ajax({
                type: "POST",
                url:"index.php?ajax=1&loaderfile=contact_insertion",
                cache:false,
                data: $(this).serializeArray(),
               success: function (data) {
                // console.log("sagar");
                   console.log(data);
                   if(data == 'success'){
                   $("#cname").val("");
                   $("#mail").val("");
                    $("#mobile").val("");
                    $("#message").val("");
                    $("#subject").val("");

                    $.notify("Successfully done", "success");
                }
                else
                    $.notify("Error occured", "danger");
               }
           });
            return false;
       });
    }
</script>