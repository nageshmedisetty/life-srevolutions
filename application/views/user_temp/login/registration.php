<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main>
    <section class="donate-section">
        <div class="section-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 mx-auto">
                    <form class="custom-form donate-form" action="<?=base_url('userjourney/welcome/signup')?>" method="post" role="form">
                        <h3 class="mb-4" style="color:#44525d">Registration</h3>

                        <div class="row">
                            <div class="col-lg-12 col-12 mt-2">
                                <input class="form-control form-control-rounded" id="name" name="name" placeholder="Jackdoe" type="text" required>
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <input class="form-control form-control-rounded" pattern="[^ @]*@[^ @]*" id="email" name="email" type="email" placeholder="Jackdoe@gmail.com" required>
                            </div>
							<div class="form-group" style="display:none;">
                                <input class="form-control form-control-rounded" id="username" name="username" type="text"  maxlength="15">
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <input class="form-control form-control-rounded" id="password" name="password" type="password" placeholder="Password" required onblur="validatepassword(this.value)">
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <input class="form-control form-control-rounded" id="repassword" name="repassword" type="password" placeholder="Re-Password"  required onblur="checkpassword(this.value)">
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <input class="form-control form-control-rounded" id="phone" name="phone" type="phone"  maxlength="10" placeholder="Phone Number" required onkeypress="validate(event)" onblur="validatephone(this.value)" >
                            </div>

                            <div class="col-lg-12 col-12 mt-2">
                                <input class="form-control form-control-rounded otp" type="text"  id="otp_1" placeholder="Enter PIN" name="otp_1" required onkeypress="validate(event)">
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <input class="form-control form-control-rounded" id="address" name="address" type="text" placeholder="Address">
                            </div>
							<div class="col-lg-12 col-12 mt-2">
                                <input class="form-control form-control-rounded" value="" id="reff" name="reff" type="reff" placeholder="Reference Code" required onblur="checkReferenceActive(this.value)">
                                <div class="blink_text text-center" id="reff_lable"><span style="color:#1c65f0;text-align:center;">Enter Reference Code</div>
                            </div>
                            

                            <div class="col-xl-12 text-center">
                                <div class="text-danger"><?=$this->session->flashdata('error')?></div>
                                <div class="text-success"><?=$this->session->flashdata('message')?></div>
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <input type="hidden" name="memtype" id="memtype" value="1" />
                                <button type="submit" id="btn_submit" class="form-control mt-4">Register</button>
                            </div>
                            <div class="col-lg-12 col-12 mt-4 text-secondary text-capitalize fw-light  text-center">If you have account <a type="button" href="<?=base_url('userjourney/welcome/login')?>" class="text-primary">LogIn</a> Now</div>
                            
                        </div>
                    </form> 
                </div>

            </div>
        </div>
    </section>
</main>

<script>
	 $('#btn_submit').prop('disabled', true);
	var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}

let digitValidate = function(ele){
  console.log(ele.value);
  ele.value = ele.value.replace(/[^0-9]/g,'');
}

let tabChange = function(val){
    let ele = document.querySelectorAll('input');
    if(ele[val-1].value != ''){
      ele[val].focus()
    }else if(ele[val-1].value == ''){
      ele[val-2].focus()
    }   
 }
function checkpassword(src){
        var password = $('#password').val();
        if(src != password){
            // swal("Sorry! Incorrect Retype Password.");
			swal("Sorry! Incorrect Retype Password.");
			$('#repassword').val("");
            exit;
        }     

    }
    function validatepassword(src){
        if(src.length < 8){
            swal("Sorry! Password Length is Minimum 8 Charactors.");
            exit;
        }
    }
    
    function validatephone(src){
        if(src.length != 10){
            swal("Sorry! Incorrect Phone Number.");
            exit;
        }
    }
function checkReferenceActive(src){
        $.ajax({
            url : "<?php echo base_url('userjourney/welcome/checkReferenceActive'); ?>",
            data : {src:src},
            type: "POST",
            dataType: "html",
            success: function(data)
            {
                if(data){
                    $('#reff_lable').html('<span style="color:#00000;text-align:center;">Reference By '+data+'</span>');
                    $('#btn_submit').prop('disabled', false);
                }else{
                    $('#reff_lable').html('<span style="color:#ff0000;text-align:center;">Sorry! This User Not Activated.</span>');
                    $('#btn_submit').prop('disabled', true);
					$('#reff').val("");
                } 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Database Error : ' + errorThrown);
            }
        });
    }


	function sendOtp(){
	var phone = $('#phone').val();
	if(!username){
		alert("Sorry! Enter Username");
		exit;
	}

        $.ajax({
            url : "<?php echo base_url('welcome/sendRegOtp'); ?>",
            data : {phone:phone},
            type: "POST",
            dataType: "html",
            success: function(data)
            {
               if(data){
				   $('#otp_msg').html('<span style="color:#1c65f0;text-align:center;">OTP Sent to your mobile number</span>');
			   }else{
				$('#otp_msg').html('<span style="color:#00ffff;text-align:center;">Sorry! Please Check your entered mobile number</span>');
			   }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Database Error : ' + errorThrown);
            }
        });
    
 }
</script>
