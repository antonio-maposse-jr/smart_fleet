<?php
    $admin_logo=getSettingsValByName('company_logo');
    $ids     = parentId();
    $authUser=\App\Models\User::find($ids);
 $subscription = \App\Models\Subscription::find($authUser->subscription);
 $routeName=\Request::route()->getName();
?>
<aside class="codex-sidebar sidebar-<?php echo e($settings['sidebar_mode']); ?>">
    <div class="logo-gridwrap">
        <a class="codexbrand-logo" href="<?php echo e(route('home')); ?>">
            <img class="img-fluid"
                 src="<?php echo e(asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')); ?>"
                 alt="theeme-logo">
        </a>
        <a class="codex-darklogo" href="<?php echo e(route('home')); ?>">
            <img class="img-fluid"
                 src="<?php echo e(asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')); ?>"
                 alt="theeme-logo"></a>
        <div class="sidebar-action"><i data-feather="menu"></i></div>
    </div>
    <div class="icon-logo">
        <a href="<?php echo e(route('home')); ?>">
            <img class="img-fluid"
                 src="<?php echo e(asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')); ?>"
                 alt="theeme-logo">
        </a>
    </div>
    <div class="codex-menuwrapper">
        <ul class="codex-menu custom-scroll" data-simplebar>
            <li class="cdxmenu-title">
                <h5><?php echo e(__('Home')); ?></h5>
            </li>
            <li class="menu-item <?php echo e(in_array($routeName,['dashboard',''])?'active':''); ?>">
                <a href="<?php echo e(route('dashboard')); ?>">
                    <div class="icon-item"><i data-feather="home"></i></div>
                    <span><?php echo e(__('Dashboard')); ?></span>
                </a>
            </li>
            <?php if(\Auth::user()->type=='super admin'): ?>
                <?php if(Gate::check('manage user')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['users.index'])?'active':''); ?>">
                        <a href="<?php echo e(route('users.index')); ?>">
                            <div class="icon-item"><i data-feather="users"></i></div>
                            <span><?php echo e(__('Users')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php else: ?>
                <?php if(Gate::check('manage user') || Gate::check('manage role') || Gate::check('manage logged history') ): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['users.index','logged.history','role.index','role.create','role.edit'])?'active':''); ?>">
                        <a href="javascript:void(0);">
                            <div class="icon-item"><i data-feather="users"></i></div>
                            <span><?php echo e(__('Staff Management')); ?></span><i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="submenu-list"
                            style="display: <?php echo e(in_array($routeName,['users.index','logged.history','role.index','role.create','role.edit'])?'block':'none'); ?>">
                            <?php if(Gate::check('manage role')): ?>
                                <li class="menu-item <?php echo e(in_array($routeName,['role.index','role.create','role.edit'])?'active':''); ?>">
                                    <a href="<?php echo e(route('role.index')); ?>"><?php echo e(__('Roles')); ?>  </a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage user')): ?>
                                <li class="<?php echo e(in_array($routeName,['users.index'])?'active':''); ?>">
                                    <a href="<?php echo e(route('users.index')); ?>"><?php echo e(__('Users')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Gate::check('manage logged history') && $subscription->enabled_logged_history==1): ?>
                                <li class="<?php echo e(in_array($routeName,['logged.history'])?'active':''); ?>">
                                    <a href="<?php echo e(route('logged.history')); ?>"><?php echo e(__('Logged History')); ?></a>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(  Gate::check('manage client') || Gate::check('manage driver') || Gate::check('manage contact') || Gate::check('manage support') || Gate::check('manage note') ): ?>
                <li class="cdxmenu-title">
                    <h5><?php echo e(__('Business Management')); ?></h5>
                </li>
                <?php if(Gate::check('manage client')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['client.index'])?'active':''); ?>">
                        <a href="<?php echo e(route('client.index')); ?>">
                            <div class="icon-item"><i data-feather="user"></i></div>
                            <span><?php echo e(__('Client')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage driver')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['driver.index'])?'active':''); ?>">
                        <a href="<?php echo e(route('driver.index')); ?>">
                            <div class="icon-item"><i data-feather="user-check"></i></div>
                            <span><?php echo e(__('Driver')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage vehicle') || Gate::check('manage inspection') ): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['vehicle.index','inspection.index','inspection.create','inspection.edit','inspection.show'])?'active':''); ?>">
                        <a href="javascript:void(0);">
                            <div class="icon-item"><i data-feather="truck"></i></div>
                            <span><?php echo e(__('Vehicles')); ?></span><i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="submenu-list"
                            style="display: <?php echo e(in_array($routeName,['vehicle.index','inspection.index','inspection.create','inspection.edit','inspection.show'])?'block':'none'); ?>">
                            <?php if(Gate::check('manage vehicle')): ?>
                                <li class="menu-item <?php echo e(in_array($routeName,['vehicle.index'])?'active':''); ?>">
                                    <a href="<?php echo e(route('vehicle.index')); ?>"><?php echo e(__('All Vehicle')); ?>  </a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage inspection')): ?>
                                <li class="<?php echo e(in_array($routeName,['inspection.index','inspection.index','inspection.create','inspection.edit','inspection.show'])?'active':''); ?>">
                                    <a href="<?php echo e(route('inspection.index')); ?>"><?php echo e(__('Inspection')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage booking')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['booking.index','booking.create','booking.edit','booking.show'])?'active':''); ?>">
                        <a href="<?php echo e(route('booking.index')); ?>">
                            <div class="icon-item"><i data-feather="file"></i></div>
                            <span><?php echo e(__('Booking')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage service')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['service.index'])?'active':''); ?>">
                        <a href="<?php echo e(route('service.index')); ?>">
                            <div class="icon-item"><i data-feather="tool"></i></div>
                            <span><?php echo e(__('Services')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage fuel')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['fuel.index'])?'active':''); ?>">
                        <a href="<?php echo e(route('fuel.index')); ?>">
                            <div class="icon-item"><i data-feather="filter"></i></div>
                            <span><?php echo e(__('Fuel')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage expense')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['expense.index'])?'active':''); ?>">
                        <a href="<?php echo e(route('expense.index')); ?>">
                            <div class="icon-item"><i data-feather="file-text"></i></div>
                            <span><?php echo e(__('Expense')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage contact')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['contact.index'])?'active':''); ?>">
                        <a href="<?php echo e(route('contact.index')); ?>">
                            <div class="icon-item"><i data-feather="phone-call"></i></div>
                            <span><?php echo e(__('Contacts')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('manage note')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['note.index'])?'active':''); ?> ">
                        <a href="<?php echo e(route('note.index')); ?>">
                            <div class="icon-item"><i data-feather="file-text"></i></div>
                            <span><?php echo e(__('Note')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(Gate::check('manage vehicle type') || Gate::check('manage inspection type')): ?>
                <li class="cdxmenu-title">
                    <h5><?php echo e(__('System Setup')); ?></h5>
                </li>
                <?php if(Gate::check('manage vehicle type')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['vehicle-type.index'])?'active':''); ?> ">
                        <a href="<?php echo e(route('vehicle-type.index')); ?>">
                            <div class="icon-item"><i data-feather="layers"></i></div>
                            <span><?php echo e(__('Vehicle Type')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage inspection type')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['inspection-type.index'])?'active':''); ?> ">
                        <a href="<?php echo e(route('inspection-type.index')); ?>">
                            <div class="icon-item"><i data-feather="check-circle"></i></div>
                            <span><?php echo e(__('Inspection Type')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(Gate::check('manage pricing packages') || Gate::check('manage pricing transation') || Gate::check('manage account settings') || Gate::check('manage password settings') || Gate::check('manage general settings') || Gate::check('manage company settings')): ?>
                <li class="cdxmenu-title">
                    <h5><?php echo e(__('System Settings')); ?></h5>
                </li>
                <?php if(Gate::check('manage pricing packages') || Gate::check('manage pricing transation')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['subscriptions.index','subscriptions.show','subscription.transaction'])?'active':''); ?>">
                        <a href="javascript:void(0);">
                            <div class="icon-item"><i data-feather="database"></i></div>
                            <span><?php echo e(__('Pricing')); ?></span><i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="submenu-list"
                            style="display: <?php echo e(in_array($routeName,['subscriptions.index','subscriptions.show','subscription.transaction'])?'block':'none'); ?>">
                            <?php if(Gate::check('manage pricing packages')): ?>
                                <li class="<?php echo e(in_array($routeName,['subscriptions.index','subscriptions.show'])?'active':''); ?>">
                                    <a href="<?php echo e(route('subscriptions.index')); ?>"><?php echo e(__('Packages')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage pricing transation')): ?>
                                <li class="<?php echo e(in_array($routeName,['subscription.transaction'])?'active':''); ?> ">
                                    <a href="<?php echo e(route('subscription.transaction')); ?>"><?php echo e(__('Transactions')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage coupon') || Gate::check('manage coupon history')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['coupons.index','coupons.history'])?'active':''); ?>">
                        <a href="javascript:void(0);">
                            <div class="icon-item"><i data-feather="gift"></i></div>
                            <span><?php echo e(__('Coupons')); ?></span><i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="submenu-list"
                            style="display: <?php echo e(in_array($routeName,['coupons.index','coupons.history'])?'block':'none'); ?>">
                            <?php if(Gate::check('manage coupon')): ?>
                                <li class="<?php echo e(in_array($routeName,['coupons.index'])?'active':''); ?>">
                                    <a href="<?php echo e(route('coupons.index')); ?>"><?php echo e(__('All Coupon')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage coupon history')): ?>
                                <li class="<?php echo e(in_array($routeName,['coupons.history'])?'active':''); ?>">
                                    <a href="<?php echo e(route('coupons.history')); ?>"><?php echo e(__('Coupon History')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage account settings') || Gate::check('manage password settings') || Gate::check('manage general settings') || Gate::check('manage company settings') || Gate::check('manage seo settings') || Gate::check('manage google recaptcha settings')): ?>
                    <li class="menu-item <?php echo e(in_array($routeName,['setting.account','setting.password','setting.general','setting.company','setting.smtp','setting.payment','setting.site.seo','setting.google.recaptcha'])?'active':''); ?>">
                        <a href="javascript:void(0);">
                            <div class="icon-item"><i data-feather="settings"></i></div>
                            <span><?php echo e(__('Settings')); ?></span><i class="fa fa-angle-down"></i></a>
                        <ul class="submenu-list "
                            style="display: <?php echo e(in_array($routeName,['setting.account','setting.password','setting.general','setting.company','setting.smtp','setting.payment','setting.site.seo','setting.google.recaptcha'])?'block':'none'); ?>">
                            <?php if(Gate::check('manage account settings')): ?>
                                <li class="<?php echo e(in_array($routeName,['setting.account'])?'active':''); ?> ">
                                    <a href="<?php echo e(route('setting.account')); ?>"><?php echo e(__('Account Setting')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage password settings')): ?>
                                <li class="<?php echo e(in_array($routeName,['setting.password'])?'active':''); ?>">
                                    <a href="<?php echo e(route('setting.password')); ?>"><?php echo e(__('Password Setting')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage general settings')): ?>
                                <li class="<?php echo e(in_array($routeName,['setting.general'])?'active':''); ?> ">
                                    <a href="<?php echo e(route('setting.general')); ?>"><?php echo e(__('General Setting')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage company settings')): ?>
                                <li class="<?php echo e(in_array($routeName,['setting.company'])?'active':''); ?>">
                                    <a href="<?php echo e(route('setting.company')); ?>"><?php echo e(__('Company Setting')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage email settings')): ?>
                                <li class="<?php echo e(in_array($routeName,['setting.smtp'])?'active':''); ?> ">
                                    <a href="<?php echo e(route('setting.smtp')); ?>"><?php echo e(__('Email Setting')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage payment settings')): ?>
                                <li class="<?php echo e(in_array($routeName,['setting.payment'])?'active':''); ?> ">
                                    <a href="<?php echo e(route('setting.payment')); ?>"><?php echo e(__('Payment Setting')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage seo settings')): ?>
                                <li class="<?php echo e(in_array($routeName,['setting.site.seo'])?'active':''); ?> ">
                                    <a href="<?php echo e(route('setting.site.seo')); ?>"><?php echo e(__('Site SEO Setting')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(Gate::check('manage google recaptcha settings')): ?>
                                <li class="<?php echo e(in_array($routeName,['setting.google.recaptcha'])?'active':''); ?> ">
                                    <a href="<?php echo e(route('setting.google.recaptcha')); ?>"><?php echo e(__('ReCaptcha Setting')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

            <?php endif; ?>
        </ul>
    </div>
</aside>
<!-- sidebar end-->
<?php /**PATH /Users/johnny/Documents/Projectos/smart-fleet-saas v2/main_file/resources/views/admin/menu.blade.php ENDPATH**/ ?>