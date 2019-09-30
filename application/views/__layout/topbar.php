<!-- header -->
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
	          <span class="sr-only">Toggle navigation</span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	        </button>
            <?php $roles = $this->session->userdata('roles'); ?>
  			<a class="navbar-brand" href="<?php echo base_url().($roles[0]['role_id'] == 4 ? 'teacherdashboard':'dashboard') ; ?>">
				<img src="<?php echo base_url(); ?>images/logo.png" alt="Citadel Insight">
			</a>
		</div>
		<div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="true">

  			<ul class="nav navbar-nav navbar-right">

		        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" id="topbar_username"><?php if($this->session->userdata('name')){echo substr(ucwords($this->session->userdata('name')) , 0,20);} ?>
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-content">
                                <div class="row">
                                    <div class="col-md-5">
                                    	<?php
										if($this->session->userdata('profile_thumb')){
											$thumbnail = base_url()."upload/profile/".$this->session->userdata('profile_thumb');
										?>
										<img id="user_avatar" src="<?php echo $thumbnail;?>" class="img-responsive img-circle"/>
										<?php
											}else{
												$thumbnail = $this->session->userdata('profile_image');
												?>
												 <img id="user_avatar" src="<?php echo $thumbnail;?>" alt="User Imange" class="img-responsive img-circle" />
												<?php
											}
										?>

                                        <p class="text-center small">
                                            <a href="<?php echo base_url() ; ?>profile#settings3">Change Photo</a></p>
                                    </div>
                                    <div class="col-md-7">
                                        <span><?php if($this->session->userdata('firstname')){echo ucwords($this->session->userdata('firstname'))." ".ucwords($this->session->userdata('lastname'));} ?></span>
                                        <p class="text-muted small" id="topbar_email">
                                            <?php if($this->session->userdata('email')){echo $this->session->userdata('email');} ?></p>
                                       <p><?php 
                                                $roles_str = '';
                                                    $location = $this->session->userdata('locations');
                                                    foreach ($this->session->userdata('roles') as $key => $value) {
                                              
                                                      $roles_str .= $value['type']." (".$location[0]['schoolname'].")";
                                                    }
                                                
                                              
                                                echo $roles_str;
                                            ?>
</p>
                                        <div class="divider">
                                        </div>
                                        <a href="<?php echo base_url() ; ?>profile#settings1" class="btn btn-primary btn-sm active">View Profile</a>
                                        <p class="text-muted small">
                                            <?php
                                                $location = $this->session->userdata('locations');
                                            	if($this->session->userdata('type')=='p'){
                                                    echo '( Principal '.$location[0]["schoolname"].' )'; 
                                                }
                                            	else if($this->session->userdata('type')=='t')
                                                {
                                            		echo "( Teacher: ".$location[0]['schoolname']." )";
                                            	}
                                             ?>



                                             </p>



                                    </div>
                                </div>
                            </div>
                            <div class="navbar-footer">
                                <div class="navbar-footer-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="<?php echo base_url() ; ?>profile#settings2" class="btn btn-default btn-sm">Change Password</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="<?php echo base_url() ; ?>logout" class="btn btn-default btn-sm pull-right">Sign Out</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <?php if(count($topbarsetting) > 0){ ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<span class="icon-cog-3 top-bar-icon" aria-hidden="true"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url() ; ?>settings">User</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url() ; ?>settings">Store</a></li>
					</ul>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>
