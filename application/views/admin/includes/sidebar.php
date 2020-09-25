<style>
	tr.selected,tr.selected td{background: transparent !important}
	.select-info{display: none !important}
</style>	


<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				

				<ul class="nav nav-list">
				
					<li class="active">
						<a href="<?=base_url('admin/user/dashboard');?>">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
			
				<?php if(RoleAccessPanel('Admin-User')){ ?>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Admin User
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						

							<li class="">
								<a href="<?=base_url();?>admin/user/admin_form">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Admin 
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?=base_url();?>admin/user/admin_list">
									<i class="menu-icon fa fa-caret-right"></i>
									Admin List
								</a>

								<b class="arrow"></b>
							</li>


						</ul>
					</li>
				<?php }if(RoleAccessPanel('User')){  ?>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> User </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url();?>admin/user/userlist">
									<i class="menu-icon fa fa-caret-right"></i>
									User List
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>
				<?php }if(RoleAccessPanel('Facility')){  ?>
					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Facility </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url();?>admin/facility">
									<i class="menu-icon fa fa-caret-right"></i>
									 User (Owner) List
								</a>
							</li>
								<li>
								<a href="<?=base_url();?>admin/facility/facbanklist">
									<i class="menu-icon fa fa-caret-right"></i>
									   User (Owner) Bank  List
								</a>

								<b class="arrow"></b>
							</li>

														<li class="">
								<a href="<?=base_url();?>admin/facility/facilityacademylist">
									<i class="menu-icon fa fa-caret-right"></i>
									 Facility / Academy List
								</a>

								<b class="arrow"></b>
							</li>

														<li class="">
								<a href="<?=base_url();?>admin/facility/facilityslotbatchesList">
									<i class="menu-icon fa fa-caret-right"></i>
									 Slot / Batch List
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?=base_url();?>admin/facility/facgallerylist">
									<i class="menu-icon fa fa-caret-right"></i>
									 Facility / Academy Gallery List
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
						
						
						

						

						
						
						
						
						
					</li>
				<?php }if(RoleAccessPanel('Booking')){  ?>	
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-laptop"></i>
							<span class="menu-text"> Booking</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url();?>admin/facility/facbookinglist">
									<i class="menu-icon fa fa-caret-right"></i>
									Slot Booking  List
								</a></li>
								<li>
								<a href="<?=base_url();?>admin/facility/facbatchbookinglist">
									<i class="menu-icon fa fa-caret-right"></i>
									Batch Booking  List
								</a>
								</li>
								
								<li>
								<a href="<?=base_url();?>admin/facility/factrialbookinglist">
									<i class="menu-icon fa fa-caret-right"></i>
									Trial Booking  List
								</a>
								</li>
								


								<b class="arrow"></b>
							</li>

							<li class="">
								
								<a href="<?=base_url();?>admin/facility/faceventlisting">
									<i class="menu-icon fa fa-caret-right"></i>
									 Event Booking List 
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
						
						</li>
					
					<?php }if(RoleAccessPanel('Interested-Sports')){  ?>	
					
						<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-futbol-o"></i>
							<span class="menu-text"> Interested Sports</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url();?>admin/master/interestedsport">
									<i class="menu-icon fa fa-caret-right"></i>
									Interested Sports List
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
						
						</li>
					<?php } if(RoleAccessPanel('Favourite')){ ?>	
						
						<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-heart-o"></i>
							<span class="menu-text"> Favourite</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url();?>admin/master/userfavouritelist">
									<i class="menu-icon fa fa-caret-right"></i>
									Favourite List
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
						
						</li>
					<?php }if(RoleAccessPanel('Event')){  ?>	
						
						
						
						<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-laptop"></i>
							<span class="menu-text"> Event</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url();?>admin/facility/faceventlist">
									<i class="menu-icon fa fa-caret-right"></i>
									 Event  List
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="">
								<a href="<?=base_url();?>admin/facility/faceventgallerylist">
									<i class="menu-icon fa fa-caret-right"></i>
									 Event Gallery list
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
						
						</li>
					<?php }if(RoleAccessPanel('Review')){  ?>	
						
						<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-star"></i>
							<span class="menu-text"> Review</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url();?>admin/facility/facreviewlist">
									<i class="menu-icon fa fa-caret-right"></i>
									 Review  List
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
						
						</li>
						
					<?php }if(RoleAccessPanel('Home-Configuration')){  ?>	
						


					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Home Configuration </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						
							<li class="">
								<a href="<?=base_url('admin/home/banner');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Banner
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?=base_url('admin/home/sport');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Sports
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?=base_url('admin/home/popular_categoties');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Popular categories
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?=base_url('admin/home/clients');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Clients
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?=base_url('admin/home/youtube');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Youtube
								</a>

								<b class="arrow"></b>
							</li>
							
						</ul>
					</li>

					<?php }if(RoleAccessPanel('Static-Pages')){  ?>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Static Pages </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						
							<li class="">
								<a href="<?=base_url('admin/cms');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Page List
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?=base_url('admin/cms/add_page_form');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Page
								</a>

								<b class="arrow"></b>
							</li>
							
							
							
							
						</ul>
					</li>
					<?php }if(RoleAccessPanel('Master-Data')){  ?>
					<!-- <li class="">
						<a href="<?=base_url('admin/cms');?>">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Static Pages </span>
						</a>

						<b class="arrow"></b>

					</li> -->
						<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Master Data </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						
							<li class="">
								<a href="<?=base_url('admin/master/sports');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Sports
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?=base_url('admin/master/reward_achievement');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Reward Achievement
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="<?=base_url('admin/master/amenity');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									 Amenities
								</a>

								<b class="arrow"></b>
							</li>

						     <li class="">
								<a href="<?=base_url('admin/master/addpackage');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Package List
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="">
								<a href="<?=base_url('admin/master/addbatchslot');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Slot Type
								</a>

								<b class="arrow"></b>
							</li>
							
						</ul>
					</li>
				<?php }if(RoleAccessPanel('Global')){  ?>
					
					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">Global</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						
							<li class="">
								<a href="<?=base_url('admin/master/globelconfig');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Global Configuration 
								</a>

								<b class="arrow"></b>
							</li>
							
							
							
							
							
							
							
						</ul>
					</li>
					<?php }if(RoleAccessPanel('Coupon')){  ?>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">Coupon</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						
							
							<li class="">
								<a href="<?=base_url('admin/facility/couponinsert');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									Coupon List
								</a>

								<b class="arrow"></b>
							</li>
							
						</ul>
					</li>
					<?php }if(RoleAccessPanel('Query')){  ?>
					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">Query</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">							
							<li class="">
								<a href="<?=base_url('admin/page/');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									 Career List
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?=base_url('admin/page/contactlisting');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									 Contact List
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?=base_url('admin/page/enquirelisting');?>">
									<i class="menu-icon fa fa-caret-right"></i>
									 Enquire List
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

				<?php }if(RoleAccessPanel('News-Letter')){  ?>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> News Letter </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url();?>admin/master/newsletterlist">
									<i class="menu-icon fa fa-caret-right"></i>
									News Letter List
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>

				<?php }  ?>

				

				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>