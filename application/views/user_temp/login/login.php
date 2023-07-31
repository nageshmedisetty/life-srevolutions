<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main>
    <section class="donate-section">
        <div class="section-overlay"></div>
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12 mx-auto">
                    <form class="custom-form donate-form" action="<?=base_url('userjourney/welcome/signin')?>" method="post" role="form">
                    <h3 class="mb-4" style="color:#44525d">LogIn</h3>    
                        <div class="row">                        
                            <div class="col-lg-12 col-12 mt-2">
                                <input class="form-control form-control-rounded" id="username" name="username" type="text" required placeholder="User Name">
                            </div>

                            <div class="col-lg-12 col-12 mt-2">
                                <input class="form-control form-control-rounded" id="password" name="password" type="password" required placeholder="Password">
                            </div>

                            

                            <div class="col-xl-12 text-center">
                                <div class="text-danger" style="padding:10px;text-align:center;"><?=$this->session->flashdata('error')?></div>
                                <div class="text-success" style="padding:10px;text-align:center;"><?=$this->session->flashdata('message')?></div>
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <button type="submit" id="btn_submit" class="form-control mt-4">LogIn</button>
                            </div>
                            <div class="col-lg-12 col-12 mt-4 text-secondary text-capitalize fw-light">If you have no account <a type="button" href="<?=base_url('userjourney/welcome/register')?>" class="text-primary">Register</a> Now</div>
                        </div>
                    </form> 
                </div>

            </div>
        </div>
    </section>
</main>
