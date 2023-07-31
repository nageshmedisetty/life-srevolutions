<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0"><?=$headtitle?></h2>                            
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        
                    </div>
                </div>
            </div>
            <div class="content-body">
              <div class="card" style="padding:10px">
                  <?php
                      $attrib = array('data-toggle' => 'validator', 'role' => 'form',  'enctype'=>"multipart/form-data");
                      echo form_open_multipart("admin/profile/update", $attrib)
                  ?> 
                      <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                          <!-- header media -->
                          <div class="media">
                              <a href="javascript:void(0);" class="mr-25">
                                  <?php
                                    if($row){
                                      if($row->path){
                                          echo '<img src="'.base_url($row->path).'" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />';
                                      }else{
                                          echo '<img src="'.base_url().'public/admin/app-assets/images/avatars/11.png" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />';
                                      }
                                    }else{
                                      echo '<img src="'.base_url().'public/admin/app-assets/images/avatars/11.png" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80" />';
                                    }
                                  ?>
                                  
                              </a>
                              <!-- upload and reset button -->
                              <div class="media-body mt-75 ml-1">
                                  <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                  <input type="file" id="account-upload" name="files" hidden accept="image/*" />
                                  <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                  <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                              </div>
                              <!--/ upload and reset button -->
                          </div>


                          <div class="row">
                                        <div class="col-12 col-sm-4" style="display:none;">
                                            <div class="form-group">
                                                <label for="refcode">Referal Code</label>
                                                <input type="text" class="form-control" id="refcode" name="refcode" placeholder="Referal Code" value="<?=($row ? $row->refcode : "")?>" readonly />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="account-username">Member Type</label>
                                                <?php                                                  
                                                    $memtype = "USER";
                                                ?>
                                                <input class="form-control form-control-rounded" value="<?=$memtype?>" />
                                                <input type="hidden" value="<?=$row ? $row->memtype : "1"?>" name="memtype" id="memtype" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="account-name">Name</label>
                                                <input class="form-control form-control-rounded" value="<?=($row ? $row->name : "")?>" id="name" name="name" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input class="form-control form-control-rounded" id="email"  value="<?=($row ? $row->email : "")?>" name="email" type="email" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                          <div class="form-group">
                                            <label for="username">Username</label>
                                            <input class="form-control form-control-rounded" id="username"  value="<?=($row ? $row->username : "")?>" name="username" type="text" maxlength="15" required>
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                              <label for="password">Password</label>
                                              <input class="form-control form-control-rounded" id="password"  value="<?=($row ? $row->password : "")?>" name="password" type="password" required onblur="validatepassword(this.value)">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                          <div class="form-group">
                                              <label for="phone">Phone</label>
                                              <input class="form-control form-control-rounded" id="phone"  value="<?=($row ? $row->phone : "")?>" name="phone" type="phone"  maxlength="10" required onblur="validatephone(this.value)">
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                          <div class="form-group">
                                              <label for="address">Address</label>
                                              <input class="form-control form-control-rounded" id="address"  value="<?=($row ? $row->address : "")?>" name="address" type="address">
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                          <div class="form-group">
                                              <label for="reff">Refferance</label>
                                              <input class="form-control form-control-rounded" id="refcode"  value="<?=($row ? $row->refcode : ($refcode ? $refcode : ""))?>" name="refcode" type="text" >
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                          <div class="form-group">
                                              <label for="reff">Pan Card Number</label>
                                              <input class="form-control form-control-rounded" id="pan"  value="<?=($row ? $row->pan : "")?>" name="pan" type="text" >
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                          <div class="form-group">
                                              <label for="reff">Aadhar Card Number</label>
                                              <input class="form-control form-control-rounded" id="aadhar"  value="<?=($row ? $row->aadhar : "")?>" name="aadhar" type="text" >
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                          <div class="form-group">
                                              <label for="reff">Bank Name</label>
                                              <input class="form-control form-control-rounded" id="bankname"  value="<?=($row ? $row->bankname : "")?>" name="bankname" type="text" >
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                          <div class="form-group">
                                              <label for="reff">Bank Account Number</label>
                                              <input class="form-control form-control-rounded" id="accno"  value="<?=($row ? $row->accno : "")?>" name="accno" type="text" >
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                          <div class="form-group">
                                              <label for="reff">IFSC Code</label>
                                              <input class="form-control form-control-rounded" id="ifsc"  value="<?=($row ? $row->ifsc : "")?>" name="ifsc" type="text" >
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                          <div class="form-group">
                                              <label for="reff">Bank Branch</label>
                                              <input class="form-control form-control-rounded" id="bankbranch"  value="<?=($row ? $row->bankbranch : "")?>" name="bankbranch" type="text" >
                                          </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                          <?php
                                            if(!$row){

                                            }else{

                                            if($row->panfront){
                                              echo '<img src="'.base_url($row->panfront).'" id="account-upload-img" class="rounded mr-50" alt="profile image" height="250" width="100%" />';
                                            ?>
                                              <div class="form-group">
                                                <label for="reff">Pan card Front Image</label>
                                                <input type="file" class="form-control form-control-rounded" id="panfront" name="panfront" accept="image/*" />
                                            </div>  
                                            <?php
                                            }else{
                                          ?>
                                          
                                            <div class="form-group">
                                                <label for="reff">Pan card Front Image</label>
                                                <input type="file" class="form-control form-control-rounded" id="panfront" name="panfront" accept="image/*" />
                                            </div>                                        
                                        
                                          <?php
                                            }
                                            ?>
                                           </div>
                                        <div class="col-12 col-sm-3">
                                        <?php
                                            if($row->panback){
                                              echo '<img src="'.base_url($row->panback).'" id="account-upload-img" class="rounded mr-50" alt="profile image" height="250" width="100%" />';
                                            ?>
                                          <div class="form-group">
                                              <label for="reff">Bank Passbook Image</label>
                                              <input type="file" class="form-control form-control-rounded" id="panback" name="panback" accept="image/*" />
                                          </div>  
                                          <?php
                                        }else{
                                          ?>  
                                          <div class="form-group">
                                              <label for="reff">Bank Passbook Image</label>
                                              <input type="file" class="form-control form-control-rounded" id="panback" name="panback" accept="image/*" />
                                          </div>
                                          <?php
                                            }
                                            ?>                                      
                                        </div>
                                        <div class="col-12 col-sm-3">
                                        <?php
                                            if($row->aadharfront){
                                              echo '<img src="'.base_url($row->aadharfront).'" id="account-upload-img" class="rounded mr-50" alt="profile image" height="250" width="100%" />';
                                            ?>
                                          <div class="form-group">
                                              <label for="reff">Aadhar card Front Image</label>
                                              <input type="file" class="form-control form-control-rounded" id="aadharfront" name="aadharfront" accept="image/*" />
                                          </div>    
                                          <?php
                                        }else{
                                          ?>    
                                          <div class="form-group">
                                              <label for="reff">Aadhar card Front Image</label>
                                              <input type="file" class="form-control form-control-rounded" id="aadharfront" name="aadharfront" accept="image/*" />
                                          </div> 
                                          <?php
                                            }
                                            ?>                                   
                                        </div>
                                        <div class="col-12 col-sm-3">
                                        <?php
                                            if($row->aadharfront){
                                              echo '<img src="'.base_url($row->aadharfront).'" id="account-upload-img" class="rounded mr-50" alt="profile image" height="250" width="100%" />';
                                            ?>
                                          <div class="form-group">
                                              <label for="reff">Aadhar card Back Image</label>
                                              <input type="file" class="form-control form-control-rounded" id="aadharback" name="aadharback" accept="image/*" />
                                          </div>  
                                          <?php
                                        }else{
                                          ?>    
                                          <div class="form-group">
                                              <label for="reff">Aadhar card Back Image</label>
                                              <input type="file" class="form-control form-control-rounded" id="aadharback" name="aadharback" accept="image/*" />
                                          </div> 
                                          <?php
                                            }
                                          }
                                            ?>                                      
                                        </div>
                                        <div class="col-12 mt-75">
                                            <div class="alert alert-warning mb-50" role="alert">
                                              <div class="col-sm-12">
                                                  <div class="text-danger" style="padding:10px;text-align:center;"><?=$this->session->flashdata('error')?></div>
                                                  <div class="text-success" style="padding:10px;text-align:center;"><?=$this->session->flashdata('message')?></div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <input type="hidden" id="id" name="id" value="<?=($row ? $row->id : 1)?>">
                                            <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                        </div>
                                    </div>
                      </div>
                  <?php echo form_close(); ?>
              </div>                
            </div>
        </div>
    </div>

<script>



$(function () {
  'use strict';

  // variables
  var form = $('.validate-form'),
    flat_picker = $('.flatpickr'),
    accountUploadImg = $('#account-upload-img'),
    accountUploadBtn = $('#account-upload');

  // Update user photo on click of button
  if (accountUploadBtn) {
    accountUploadBtn.on('change', function (e) {
      var reader = new FileReader(),
        files = e.target.files;
      reader.onload = function () {
        if (accountUploadImg) {
          accountUploadImg.attr('src', reader.result);
        }
      };
      reader.readAsDataURL(files[0]);
    });
  }

  // flatpickr init
  if (flat_picker.length) {
    flat_picker.flatpickr({
      onReady: function (selectedDates, dateStr, instance) {
        if (instance.isMobile) {
          $(instance.mobileInput).attr('step', null);
        }
      }
    });
  }

  // jQuery Validation
  // --------------------------------------------------------------------
  if (form.length) {
    form.each(function () {
      var $this = $(this);

      $this.validate({
        rules: {
          username: {
            required: true
          },
          name: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          password: {
            required: true
          },
          company: {
            required: true
          },
          'new-password': {
            required: true,
            minlength: 6
          },
          'confirm-new-password': {
            required: true,
            minlength: 6,
            equalTo: '#account-new-password'
          },
          dob: {
            required: true
          },
          phone: {
            required: true
          },
          website: {
            required: true
          },
          'select-country': {
            required: true
          }
        }
      });
      $this.on('submit', function (e) {
        e.preventDefault();
      });
    });
  }
});

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

</script>