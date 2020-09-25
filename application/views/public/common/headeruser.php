<style>
.loginuserddashboard{
color: #fff !important;
line-height: 57px;
}

.c-header-icon2
{
 position: absolute;
    color: #fff;
    top: 18px;
    font-size: 20px; 
    cursor: pointer;
}

.c-header-icon2:hover
{
    color: #ec4612;  
}



</style>  

<header class="l-header luser">
  <div class="c-header-icon2">
  <i class="fa fa-chevron-left"></i>
</div>
<div class="container">
<div class="row">
       <div class="col-sm-3 logo middleitem">
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/public/images/logo.png"></a>
           
        </div>
       
       <div class="col-sm-9 text-right">
        <?php if($this->session->userdata('user_id') && $this->session->userdata('user_role')=='1') { ?>
               <div class="dropdown header-icons-group" style="border:none">
        <a class="nav-link dropdown-toggle btn-profile" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="username_dashboard"><?php $get_data=$this->CommonMdl->getRow('tbl_user','user_name',array('user_id'=>$this->session->userdata('user_id')));
							echo $get_data->user_name;?></span>
        </a>
        <div class="dropdown-menu profile_ui dropdown-menu-right" aria-labelledby="navbarDropdown" x-placement="bottom-end" style="position: absolute; top: 56px; left: -80px; will-change: top, left;">
            <div class="arrow-up red"></div>
            <div class="card">

                <div class="card-body py-0 px-2">
                    <ul class="list-unstyled list_menu_items">

                        <li><a href="<?=base_url('dashboard/user_profile');?>"><img src="<?=base_url('assets/public/images/icon/user.png');?>" alt=""> My profile</a></li>
                        <li><a href="<?=base_url('login/logout');?>" id="logOutSession"><img src="<?=base_url('assets/public/images/icon/logout.png');?>" alt=""> Log out</a></li>
                    </ul>
                </div>                                  
            </div>
        </div>
    </div>
    <?php }
else{ ?>
 
        <a class="loginuserddashboard" href="<?=base_url('login');?>" role="button"> <span class="username_dashboard">Login/Register</span>
        </a>
      
    </div>
<?php }
     ?>
       </div>

      </div>
</div>
</header>

<script>
  $(".c-header-icon2").on("click", function() {
window.history.back();
  });

  </script>