<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <!-- <img src="https://www.searchpng.com/wp-content/uploads/2019/02/Men-Profile-Image.png" alt=""/> -->
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b>
                        <?php echo $this->session->userdata('name') ?>
                    </div>
                </a>
            </li>
            <li>
                <ul class="nav nav-profile">
                    <li class=""><a href="#"><i class="fa fa-cog"></i> Edit Profile</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="<?php echo $this->uri->segment(1)=="home"?"active":"";?> has-sub">
                <a href="<?php echo base_url('home');?>">  
                    <i class="fa fa-home"></i> 
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="<?php echo $this->uri->segment(1)=="bansos"?"active":"";?> has-sub">
                <a href="<?php echo base_url('bansos/index_bansos');?>">  
                    <i class="fa fa-th-large"></i> 
                    <span>Bansos</span>
                </a>
            </li>
            <?php if($this->session->userdata('tipe_user') == "admin") : ?>
            <li class="<?php echo $this->uri->segment(1)=="kriteria"?"active":"";?> has-sub">
                <a href="<?php echo base_url('kriteria/view_criteria');?>">  
                    <i class="fa fa-list-ul"></i> 
                    <span>Kriteria</span>
                </a>
            </li>
            
           
            <li class="<?php echo $this->uri->segment(1)=="alternatif"?"active":"";?> has-sub">
                <a href="<?php echo base_url('alternatif');?>">
                    <i class="fa fa-book"></i> 
                    <span>Data Calon Penerima</span>
                </a>
            </li>

            <li class="<?php echo $this->uri->segment(1)=="edas"?"active":"";?> has-sub">
                <a href="<?php echo base_url('edas');?>">
                    <i class="fa fa-cogs" aria-hidden="true"></i> 
                    <span>Metode EDAS</span>
                </a>
            </li>
            <?php endif?>

            <li class="<?php echo $this->uri->segment(1)=="rank"?"active":"";?> has-sub">
                <a href="<?php echo base_url('rank');?>">
                    <i class="fa fa-users"></i> 
                    <span>Penerima Bantuan Sosial</span>
                </a>
            </li>

            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
        </ul>
    </div>
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
