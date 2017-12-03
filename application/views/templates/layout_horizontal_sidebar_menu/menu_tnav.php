<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <?php
        	$n = get_notif_stnk_expired();
			$t = $n[0]->total;
			
			$k = get_notif_keluhan();
			$tk = $k[0]->total;
			
			$tt = $t + $tk;
		?>
        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <i class="icon-bell"></i>

            <span class="badge badge-danger"> <?= $tt ?> </span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <ul class="dropdown-menu-list scroller" style="height: 100px;">
                        <?php if($t){ ?>
                        <li>
                            <a href="<?= base_url() ?>ms_kendaraan?x=4&y=2">
                                <span class="label label-sm label-icon label-success">
                                </span><?= $t ?> STNK Expired <span class="time"></span>
                            </a>
                        </li>
                        <?php } ?>
                        
                        <?php if($tk){ ?>
                        <li>
                            <a href="<?= base_url() ?>t_spk?x=7&y=8&xstatus_keluhan=Open">
                                <span class="label label-sm label-icon label-success">
                                </span><?= $tk ?> Keluhan <span class="time"></span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- END NOTIFICATION DROPDOWN -->
        
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <?php
        	// get Full Name by userid $auth_user_id is the global variable from CI Auth to get UserID
			$fullname = $this->auth_username;
		?>
        <li class="dropdown dropdown-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            
            <span class="username username-hide-on-mobile">
            <?= $fullname ?> </span>
            <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li id="user_profile">
                    <a href="<?= base_url() ?>user_profile?z=dropdownmenu">
                    <i class="icon-user"></i> Profil Saya </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>auth/logout">
                    <i class="icon-key"></i> Log Out </a>
                </li>
            </ul>
        </li>
    </ul>
</div>

<script>
	if( "<?= $this->input->get('z') ?>" != "" ){
		$(".dropdown-menu #<?= $this->uri->segment('1'); ?>").addClass('active');
	}
</script>