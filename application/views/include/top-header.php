<div id="header" class="header navbar-default">
    <div class="navbar-header">
        <a href="<?php echo base_url('home');?>" class="navbar-brand"><span class="navbar-logo"></span> <b>Bansos</b> WEB</a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown navbar-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- <img src="https://teoremamoda.shop/pub/media/mgs_brand/e/d/edas-logo-teorema-moda.png" alt="" />  -->
                <i class="fa fa-user-circle"></i>
                <span class="d-none d-md-inline">Nama</span> <b class="caret"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <!-- <a href="javascript:;" class="dropdown-item">Edit Profile</a> -->
                <!-- <a href="javascript:;" class="dropdown-item">Calendar</a> -->
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url(); ?>user/logout" class="dropdown-item">Log Out</a>
            </div>
        </li>
    </ul>
</div>