<!-- top navigation -->
<div class="top_nav menu_fixed">
    <div class="nav_menu">
    <nav>
        <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
        <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="<?=base_url('assets/build/profiles/'.$this->session->userdata('image'))?>" alt=""><?php echo $this->session->userdata('username'); ?>
            <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><h4 align="center" style="font-family:monospace;"><?php echo $this->session->userdata('usertype'); ?></h4></li>
            <li>
                <a href="<?=base_url('Settings');?>">
                <span>Settings</span>
                </a>
            </li>
            <li><a href="<?=base_url('users/logout')?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
            </ul>
        </li>
        </ul>
    </nav>
    </div>
</div>
<!-- /top navigation -->