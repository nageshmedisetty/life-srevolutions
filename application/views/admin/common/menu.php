<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>            
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">           
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"><?='Hi, '.$this->session->userdata('user')?></span><span class="user-status"><?=$this->session->userdata('refcode')?></span></div><span class="avatar"><img class="round" src="<?=base_url('public/admin/')?>app-assets/images/portrait/small/avatar.png" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="page-account-settings.html">
                        <i class="mr-50" data-feather="settings"></i> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?=base_url('userjourney/welcome/logout')?>">
                        <i class="mr-50" data-feather="power"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="<?=base_url('admin/dashboard')?>">
                    <img src="<?=base_url('public/temp/images/logo.png')?>" class="brand-logo" alt="Life Srevolutions" width="28">                           
                    <h2 class="brand-text">Life Srevolutions</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                
                
                <li class=" nav-item"><a class="d-flex align-items-center" href="<?=base_url('admin/pinmanage')?>"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Generate Pin</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="<?=base_url('admin/category')?>"><i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Category</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="<?=base_url('admin/subcategory')?>"><i data-feather="check-square"></i><span class="menu-title text-truncate" data-i18n="Todo">Sub&nbsp;category</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="<?=base_url('admin/items')?>"><i data-feather="calendar"></i><span class="menu-title text-truncate" data-i18n="Calendar">Products</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="<?=base_url('admin/reports')?>"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Kanban">Reports</span></a>
                </li>
                
            </ul>
        </div>
    </div>