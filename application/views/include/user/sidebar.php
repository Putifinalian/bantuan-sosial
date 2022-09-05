<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="https://www.searchpng.com/wp-content/uploads/2019/02/Men-Profile-Image.png" alt=""/>
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b>
                        <?= $this->session->userdata('name') ?>
                    </div>
                </a>
            </li>
            <li>
                <ul class="nav nav-profile">
                    <!-- <li class=""><a href="#"><i class="fa fa-cog"></i> Home</a></li> -->
                </ul>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="<?php echo $this->uri->segment(1)=="home"?"active":"";?> has-sub">
                <a href="<?php echo base_url('home');?>">  
                    <i class="fa fa-th-large"></i> 
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="<?php echo $this->uri->segment(1)=="bansos"?"active":"";?> has-sub">
                <a href="<?php echo base_url('bansos/index_bansos');?>">  
                    <i class="fa fa-th-large"></i> 
                    <span>Bansos</span>
                </a>
            </li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fas fa-list-ul"></i>
                    <span>Kriteria</span>
                </a>
                <ul class="sub-menu">
                    <li class=" has-sub">
                        <li class=""><a href="<?php echo base_url('kriteria/view_criteria'); ?>">Tambah Kriteria</a></li>       
                    </li>
                </ul>
            </li>

            <li class="<?php echo $this->uri->segment(1)=="rank"?"active":"";?> has-sub">
                <a href="<?php echo base_url('rank');?>">
                    <i class="fa fa-users"></i> 
                    <span>Data Penerima Bansos</span>
                </a>
            </li>

            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
        </ul>
    </div>
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->