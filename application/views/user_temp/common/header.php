<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Charity - <?=$header_title?></title>    
        <link href="<?=base_url('public/temp/')?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=base_url('public/temp/')?>css/bootstrap-icons.css" rel="stylesheet">
        <link href="<?=base_url('public/temp/')?>css/templatemo-kind-heart-charity.css" rel="stylesheet">
    </head>
    
    <body id="section_1">
	<header class="site-header">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-8 col-12 d-flex flex-wrap">
                        <p class="d-flex me-4 mb-0">
                            <i class="bi-geo-alt me-2"></i>
                            Visakhaptnam, India
                        </p>

                        <p class="d-flex mb-0">
                            <i class="bi-envelope me-2"></i>

                            <a href="mailto:info@company.com">
                                info@lifesrevolutions.com
                            </a>
                        </p>
                    </div>

                    <div class="col-lg-2 col-12 ms-auto d-lg-block d-none text-white text-right">
                        <?=($this->session->userdata('user') ? 'Hi, '.$this->session->userdata('user') : 'Please <a href="'.base_url('userjourney/welcome/login').'">Login</a> For More')?>&nbsp;<i class="bi-person-circle"></i>
                        <!-- <ul class="social-icon">
                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-twitter"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-facebook"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-youtube"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-whatsapp"></a>
                            </li>
                        </ul> -->
                    </div>

                </div>
            </div>
        </header>
		<nav class="navbar navbar-expand-lg bg-light shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="<?=base_url()?>">
                    <img src="<?=base_url('public/temp/')?>images/logo.png" class="logo img-fluid" alt="Life Srevolutions">
                    <span>
                        Life Srevolutions
                        <small>Caption Comes Here</small>
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#top">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_2">About</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_3">Causes</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_4">Volunteer</a>
                        </li>                    

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_6">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('admin/dashboard')?>">Admin Panal</a>
                        </li>
                        <li class="nav-item ms-3">
                            <?php
                                if($this->session->userdata('userid')){
                                    echo '<a class="nav-link custom-btn custom-border-btn btn" href="'.base_url('userjourney/welcome/logout').'">Logout</a>';
                                }else{
                                    echo '<a class="nav-link custom-btn custom-border-btn btn" href="'.base_url('userjourney/welcome/login').'">LogIn/SignUp</a>';
                                }
                            ?>                            
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>