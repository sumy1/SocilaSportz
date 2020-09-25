<?php //authorizeUrl($this->session->userdata['role_id']); ?>

<div id="navbar" class="navbar navbar-default ace-save-state">

	<div class="navbar-container ace-save-state" id="navbar-container">

		<div class="navbar-header pull-left">

             
        <a href="<?=base_url('admin/user/dashboard');?>"><img class="navbar-brand" style="max-height: 70px;" src="<?=base_url();?>assets/admin/images/logo.png"></a>

		</div>

		<div class="navbar-buttons navbar-header pull-right" role="navigation">

			<ul class="nav ace-nav">

				<li class="light-blue dropdown-modal">

					<a data-toggle="dropdown" href="#" class="dropdown-toggle">

						<!--<img class="nav-user-photo" src="<?php echo base_url('assets/admin/images/avatars/user.jpg');?>" alt="Jason's Photo" />-->

						<span class="user-inlfo" id="welcomeuser" style="min-width:200px !important; font-size: 17px;    text-transform: capitalize;">

							<small>Welcome,</small>

							<?php echo $this->session->userdata['admin_username']; ?>

						</span>

						<i class="ace-icon fa fa-caret-down"></i>

					</a>

					<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

						<li class="divider"></li>

						<li>

                         <?php echo anchor('admin/user/logout', '<i class="ace-icon fa fa-power-off"></i> Logout') ?>							

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</div><!-- /.navbar-container -->

</div>

