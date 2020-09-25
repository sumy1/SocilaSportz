<style>
.header-icons-group a.nav-link.btn-profile{line-height: 33px !important;}
.dropdown-menu a{color:#000 !important;}
.dropdown-menu ul{width: 200px;}
.dropdown-menu.profile_ui.dropdown-menu-right{    width: 100% !important; max-width: 230px;}
.dropdown-menu.profile_ui.dropdown-menu-right li{padding: 0px !important;
	width: 100%; 
	background: #fff !important;
}

.mobilehide1 .fa.fa-caret-down
{
	float: 	none !important;
	right:inherit !important;
	color: 	#fff !important;
}	
</style>

<header class="blackbg">
	<div class="topbar">
		<div class="container">
			<div class="row">
				
				<div class="pull-right col-sm-12">
				<?php $getglobeldata=$this->CommonMdl->getRow('tbl_globel_config',$clms='*',$whr='');  ?>
                      <ul class="topnav topmenu socialicon">
						<li><a href="<?=$getglobeldata->fb_link;?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li><a href="<?=$getglobeldata->linkedin_link;?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="<?=$getglobeldata->twitter_link;?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<?php if($this->session->userdata('user_id') && $this->session->userdata('user_role')=='1') { ?>
						<div class="dropdown header-icons-group" style="border:none">
							<a class="nav-link dropdown-toggle btn-profile" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="username_dashboard">
							<?php
							$get_data=$this->CommonMdl->getRow('tbl_user','user_name',array('user_id'=>$this->session->userdata('user_id')));
							echo $get_data->user_name;
						?></span>
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
						<li class="loginlink"><a href="<?=base_url('login');?>">Login/Register</a></li>
						<?php } ?>
					</ul>
					<ul class="topnav topmenudark">
						<li><a href="mailto:info@socialsportz.com"><i class="fa fa-envelope"></i><?=$getglobeldata->config_email;?></a></li>
						<li><span style="color: #fff; padding: 10px 20px;" ><i class="fa fa-phone"></i><?=$getglobeldata->config_phone;?></span></li>
					</ul>


				</div>
			</div>

		</div>
	</div>


	<div class="fixonscroll">
		<div class="container logo-wrapper">


			<div class="row">
				<div class="col-sm-3 logo middleitem">
					<a href="<?=base_url();?>"><img src="<?=base_url('assets/public/images/logo.png')?>"></a>
					<i class="fa fa-bars toggleicon"></i>
				</div>

				<div class="col-sm-9 menutop nopadright">
					<ul class="topnav topnav2">
						<li class="activenav"><a href="<?=base_url();?>">Home</a>
							<ul class="dropdown-item">
								<li class="active"><a href="<?=base_url();?>">Home</a>
									
								</li>

							</ul>
						</li>
						<li class=""><a href="<?=base_url('searchlisting/facility');?>">Facility</a></li>
						<li class=""><a href="<?=base_url('searchlisting/event');?>">Event</a></li>
						
						<li class=""><a href="<?=base_url('page/aboutus');?>">About Us</a></li>
						<li class=""><a href="<?=base_url('page/partner_with_us');?>">Partner With Us</a></li>
						
						<li class=""><a href="<?=base_url('page/contact_us');?>">Contact Us</a></li>
 
                      	<?php if($this->session->userdata('user_id') && $this->session->userdata('user_role')=='1') { ?>
						<li class="mobilehide1">
							<a>
                       <span class="username_dashboard" style="color:#fff"><?=$this->session->userdata('user_name')?> <i class="fa fa-caret-down"></i></span>
                   </a>

							
							
			<ul class="list-unstyled list_menu_items">

											<li><a href="<?=base_url('dashboard/user_profile');?>"><img src="<?=base_url('assets/public/images/icon/user.png');?>" alt=""> My profile</a></li>
											<li><a href="<?=base_url('login/logout');?>" id="logOutSession"><img src="<?=base_url('assets/public/images/icon/logout.png');?>" alt=""> Log out</a></li>
										</ul>
						

					</li>
						<?php }
						else{ ?>
						<li class="mobilehide1"><a href="<?=base_url('login');?>">Login/Register</a></li>
						<?php } ?>
					</ul>


				</div>
			</div>
		</div>
	</div>
</header>

