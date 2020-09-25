<?php
$last = $this->uri->total_segments();
$last_uri = $this->uri->segment($last);
?>
<style>
	.modal .btn{text-transform: capitalize !important;}
</style>

<div class="col-sm-12 text-center">
	<i class="fa fa-bars usertoggle"></i>
</div>

<ul class="list-unstyled profile_sidebar_list">
		<li>
			<a href="<?=base_url('dashboard');?>" class="<?= ($last_uri == 'dashboard') ? 'active':''; ?>">
				<i class="fa fa-file-text-o img_icon"></i>
				<strong>Dashboard</strong>
				<span>Get An Overview Of Your Account</span>
			</a>
		</li>
		<li>
			<a href="<?=base_url('dashboard/user_profile');?>" class="<?= ($last_uri == 'user_profile' || $last_uri == 'user_change_password') ? 'active':''; ?>">
				<i class="fa fa-history img_icon"></i>
				<strong>Edit Profile</strong>
				<span>You can edit your personal information</span>
			</a>
		</li>

		
		<li>
			<a href="<?=base_url('dashboard/user_booking');?>" class="<?= ($last_uri == 'user_booking') ? 'active':''; ?>">
				<i class="fa fa-laptop img_icon"></i>
				<strong>My Bookings</strong>
				<span>Check Your Bookings</span>
			</a>
		</li>
		
		<li>
			<a href="<?=base_url('dashboard/user_favourite');?>" class="<?= ($last_uri == 'user_favourite') ? 'active':''; ?>">
				<i class="fa fa-heart-o img_icon"></i>
				<strong>My Favourite</strong>
				<span>Check Your Favourite</span>
			</a>
		</li>
	
		
		
		<li>
			<a href="<?=base_url('dashboard/user_notification');?>" class="<?= ($last_uri == 'user_notification') ? 'active':''; ?>">
				<i class="fa fa-bell img_icon"></i>
				<strong>Notifications</strong>
				<span>Your  Alerts</span>
			</a>
		</li>
		<li>
			<a href="<?=base_url('dashboard/user_rating');?>" class="<?= ($last_uri == 'user_rating') ? 'active':''; ?>">
				<i class="fa fa-star img_icon"></i>
				<strong>Review & Rating</strong>
				<span>My Feedback</span>
			</a>
		</li>
		
		<li>
			<a href="<?=base_url('dashboard/user_interested_sport');?>" class="<?= ($last_uri == 'user_interested_sport') ? 'active':''; ?>">
				<i class="fa fa-futbol-o img_icon"></i>
				<strong>Interested Sports</strong>
				<span>Crazy About Your Sports</span>
			</a>
		</li>

		<li>
			<a href="<?=base_url('dashboard/subscription');?>" class="<?= ($last_uri == 'subscription') ? 'active':''; ?>">
				<i class="fa fa-newspaper-o img_icon"></i>
				<strong>Subscribe Newsletter</strong>
				<span>Get our latest updates</span>
			</a>
		</li>
		<li>
			<a href="<?=base_url('dashboard/user_query');?>" class="<?= ($last_uri == 'user_query') ? 'active':''; ?>">
				<i class="fa fa-question-circle img_icon"></i>
				<strong>My Enquiry</strong>
				<span>Get our latest updates</span>
			</a>
		</li>
		
		<li>
			<a href="<?=base_url('login/logout');?>" class="">
				<i class="fa fa-sign-out img_icon"></i>
				<strong>Logout</strong>
				<span></span>
			</a>
		</li>
		
	</ul>

	<script>
$(document).on("click",'.usertoggle', function(){$('.profile_sidebar_list').slideToggle()});
	</script>	