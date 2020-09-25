	<?php
$last = $this->uri->total_segments();
$last_uri = $this->uri->segment($last);

/*$unread_notification=$this->CommonMdl->fetchNumRows('tbl_notification',array('notification_status'=>'unread'),$cond1='');*/
$unread_email_notification=$this->CommonMdl->fetchNumRows('tbl_email_notification',array('email_notification_status'=>'unread','user_id'=>$this->session->userdata('user_id')),$cond1='');
 ?>
<style>
#headeracademyfacility{display: none;}
</style>

<header class="l-header">

		<div class="mobileshow"><div class="col-sm-3 logo middleitem">
			<a href="<?=base_url('dashboard');?>"><img src="<?=base_url('assets/public/images/logo.png')?>"></a>
			<i class="fa fa-bars toggleicondashboard"></i>
		</div></div>
		<div class="l-header__inner clearfix">

			<div class="c-header-icon dropdown bell-icon">
				<a class="nav-link dropdown-toggle bell-notification" href="<?=base_url('facility/notification');?>"><span class="c-badge c-badge--header-icon animated shake fac_unread"></span>
					<i class="fa fa-bell"></i></span>
				</a>

			</div>
			<div class="c-header-icon"><a class="dropdown-toggle bell-notification" href="<?=base_url('facility/notification/email_notification');?>"><span class="c-badge c-badge--header-icon animated shake mailboxnum"><?=$unread_email_notification;?></span><i class="fa fa-envelope" aria-hidden="true"></i></a>
				
			</div>
			<div class="dropdown c-search ">
				<?php
						$order_by = array('col_name'=>'fac_type','order'=>'desc');
						$fac_data = $this->CommonMdl->getResultByCond('tbl_facility',array('user_id'=>$this->session->userdata('user_id')),'fac_name,fac_id,fac_type',$order_by);
						if(isset($fac_data) && $fac_data!=''){?>
								<select id="headeracademyfacility">
									<?php foreach ($fac_data as $fac_list) {  ?>
									<option fac_type="<?=$fac_list->fac_type;?>" value="<?=$fac_list->fac_id;?>"><?=$fac_list->fac_name;?></option>
									
									<?php } ?>
								</select>

								
					
							<?php } ?>
				<a class="nav-link dropdown-toggle search-btn" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <div class="username_dashboard selectedacademy"></div>
				</a>
				<div class="dropdown-menu profile_ui dropdown-menu-right" aria-labelledby="navbarDropdown" x-placement="bottom-end" style="position: absolute; top: 68px; left: 0; will-change: top, left;width: 100%;">
					<div class="arrow-up red"></div>
					<div class="card">

			</div>


		</div>
	</div>
	<div class="dropdown header-icons-group">
		<a class="nav-link dropdown-toggle btn-profile" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="username_dashboard"><?php  $User_data=$this->CommonMdl->getRow('tbl_user','user_name',array('user_id'=>$this->session->userdata('user_id')));
		 echo $User_data->user_name;?></span>
		</a>
		<div class="dropdown-menu profile_ui dropdown-menu-right" aria-labelledby="navbarDropdown" x-placement="bottom-end" style="position: absolute; top: 56px; left: -80px; will-change: top, left;">
			<div class="arrow-up red"></div>
			<div class="card">

				<div class="card-body py-0 px-2">
					<ul class="list-unstyled list_menu_items">

						<li><a href="<?=base_url('dashboard/accountinfo');?>"><img src="<?=base_url('assets/public/images/icon/user.png')?>" alt=""> My profile</a></li>
						<li><a href="<?=base_url('login/logout');?>" id="logOutSession"><img src="<?=base_url('assets/public/images/icon/logout.png')?>" alt=""> Log out</a></li>
					</ul>
				</div>									
			</div>
		</div>
	</div>
</div>

<select style="display: none">
	<option>Prakash Padukone Badminton Academy</option>
	<option>MaryKom boxing Academy</option>
</select>
</header>

<div class="l-sidebar">
	<div class="logo">
	
		<div class="logo" id="rnr-logo">
			<a href="<?=base_url('dashboard');?>"><div class="logo__txt"><img src="<?=base_url('assets/public/images/logo.png')?>" class="img-fluid"></a></div>
		</div>
	</div>
	
		<div class="l-sidebar__content">
			<nav class="c-menu js-menu">
				<ul class="u-list">
					<a href="<?=base_url('dashboard');?>"><li class="c-menu__item <?php if($last_uri == 'dashboard') echo "is-active"; ?> ">
						<div class="c-menu__item__inner"><i class="fa fa-file-text-o"></i>
							<div class="c-menu-item__title"><span>My Dashboard</span></div>
						</div>
					</li></a>
					
					<a href="<?=base_url('dashboard/accountinfo');?>"><li class="c-menu__item has-submenu <?php if($last_uri == 'accountinfo') echo "is-active"; ?>" >
						<div class="c-menu__item__inner"><i class="fa fa-history"></i>
							<div class="c-menu-item__title"><span>My Profile</span></div>
						</div>
					</li></a>
		

					<a href="<?=base_url('facility/slot');?>"><li class="c-menu__item has-submenu <?php if($last_uri == 'slot') echo "is-active"; ?>"  >
						<div class="c-menu__item__inner"><i class="fa fa-address-book-o"></i>
							<div class="c-menu-item__title"><span id="slot_batch_a">Slots/Batches</span></div>
						</div>
					</li></a>
					<a href="<?=base_url('facility/booking');?>"><li class="c-menu__item has-submenu <?php if($last_uri == 'booking') echo "is-active"; ?>" >
						<div class="c-menu__item__inner"><i class="fa fa-laptop"></i>
							<div class="c-menu-item__title"><span>Bookings</span></div>
						</div>
					</li></a>
					<!-- <a href="<?=base_url('facility/booking/offline_booking');?>"><li class="c-menu__item has-submenu <?php if($last_uri == 'offline_booking') echo "is-active"; ?>" >
						<div class="c-menu__item__inner"><i class="fa fa-desktop"></i>
							<div class="c-menu-item__title"><span>Offline Booking</span></div>
						</div>
					</li></a> -->
					<a href="<?=base_url('facility/event');?>"><li class="c-menu__item has-submenu <?php if($last_uri == 'event') echo "is-active"; ?>"  >
						<div class="c-menu__item__inner"><i class="fa fa-calendar"></i>
							<div class="c-menu-item__title"><span>My Events</span></div>
						</div>
					</li></a>
					<a href="<?=base_url('facility/enquiry');?>"><li class="c-menu__item has-submenu <?php if($last_uri == 'enquiry') echo "is-active"; ?>" >
						<div class="c-menu__item__inner"><i class="fa fa-question-circle"></i>
							<div class="c-menu-item__title"><span>Enquiries</span></div>
						</div>
					</li></a>
					<a href="<?=base_url('facility/review');?>"><li class="c-menu__item has-submenu <?php if($last_uri == 'review') echo "is-active"; ?>"  >
						<div class="c-menu__item__inner"><i class="fa fa-star"></i>
							<div class="c-menu-item__title"><span>Review Summary</span></div>
						</div>
					</li></a>
					
					<a href="<?=base_url('facility/notification');?>"><li class="c-menu__item has-submenu <?php if($last_uri == 'notification') echo "is-active"; ?> ">
						<div class="c-menu__item__inner"><i class="fa fa-bell"></i>
							<div class="c-menu-item__title"><span>Notifications</span></div>
						</div>
					</li></a>
					<a href="<?=base_url('facility/notification/email_notification');?>"><li class="c-menu__item has-submenu <?php if($last_uri == 'email_notification') echo "is-active"; ?>"  >
						<div class="c-menu__item__inner"><i class="fa fa-envelope"></i>
							<div class="c-menu-item__title"><span>Admin Email Alerts</span></div>
						</div>
					</li></a>

					<a href="<?=base_url('facility/states');?>"><li class="c-menu__item has-submenu <?php if($last_uri == 'states') echo "is-active"; ?>"  >
						<div class="c-menu__item__inner"><i class="fa fa fa-bar-chart"></i>
							<div class="c-menu-item__title"><span>Statistics</span></div>
						</div>
					</li></a>
				</ul>
			</nav>
		</div>
	</div>

<script>

setTimeout(function(){
	if (typeof Cookies.get("yourCookieName") === 'undefined'){


} else {
 jQuery('.selectedacademy').text(Cookies.get("yourCookieName"));
 $('#headeracademyfacility option[value="' + Cookies.get("yourCookieselectvalue") + '"]').attr('selected', 'selected');
}

},600);
	jQuery("#headeracademyfacility option").each(function(){
		var cdf = jQuery(this).text();
		jQuery(".dropdown.c-search .card").append('<a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+ cdf +'<span class="username_dashboard "></span><div class="ripple-container"></div></a>');

	});

var ddd = jQuery("#headeracademyfacility option:eq(0)").text();
	jQuery('.selectedacademy').text(ddd);
	


	jQuery(".dropdown-menu a.nav-link").on("click", function(){
var mgh = jQuery('.selectedacademy').text();
console.log(mgh);
	 var cdf = jQuery(this).text();
	 var abc = cdf.trim();
		Cookies.set("yourCookieName", abc);
jQuery("#headeracademyfacility option").each(function(){
	var ndf = jQuery(this).text();
	if(ndf == abc){jQuery("#headeracademyfacility option").attr("selected", false); jQuery(this).attr("selected", true);
	     var kkkk = jQuery(this).val(); 
         Cookies.set("yourCookieselectvalue", kkkk);

if(mgh!=abc)
{
setTimeout(function(){
location.reload();
},100);
}
     
	 }


});

	 });


$(document).ready(function(){
	setTimeout(function(){
    var fac_id =$("#headeracademyfacility option:selected" ).val();
	$.ajax({
		type: "POST",
        //async: true,
        url:'<?php echo base_url();?>facility/notification/unread_notification_count',
        data: {fac_id:fac_id},
        success:function(res){
        	
        		$('.fac_unread').text(res);
                    }              
                });

		},700);
		});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>
<script>
/*var anm = jQuery("#navbarDropdown .selectedacademy").text();
Cookies.set("yourCookieName", anm);*/

$("#navbarDropdown, .nav-link.dropdown-toggle.btn-profile").on("click", function(){
$(".dropdown.c-search, .dropdown.header-icons-group").removeClass("open");
});

</script>