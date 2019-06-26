<template>
    <div>

        <div class="leftpanel">
            <div class="leftpanelinner">

                <!-- ################## LEFT PANEL PROFILE ################## -->

                <div class="media leftpanel-profile">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle" :src="`https://cryptotraderslab.com/public/images/find_user.png`" alt="" v-if="authUser.pro_pic == ''">
                            <img class="media-object img-circle" :src="`https://cryptotraderslab.com/public/alex_images/` + authUser.pro_pic" alt="" v-if="authUser.pro_pic != null">

                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ authUser.full_name }} <a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a></h4>
                        <span>{{ authUser.phone }}</span>
                    </div>
                </div><!-- leftpanel-profile -->

                <div class="leftpanel-userinfo collapse" id="loguserinfo">
                    <h5 class="sidebar-title">Location</h5>
                    <span class="pull-right"> {{ authUser.country }}</span>
                    <h5 class="sidebar-title">Contact</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label class="pull-left">Email</label>
                            <span class="pull-right">{{ authUser.email }}</span>
                        </li>
                        <li class="list-group-item">
                            <label class="pull-left">Mobile</label>
                            <span class="pull-right">{{ authUser.phone }}</span>
                        </li>
                        <li class="list-group-item">
                            <label class="pull-left">Social</label>
                            <div class="social-icons pull-right">
                                <a href="#"><i class="fa fa-facebook-official"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div><!-- leftpanel-userinfo -->

                <ul class="nav nav-tabs nav-justified nav-sidebar">
                    <li class="tooltips active" data-toggle="tooltip" title="Main Menu"><a data-toggle="tab" data-target="#mainmenu"><i class="tooltips fa fa-ellipsis-h"></i></a></li>
                   <!-- <li class="tooltips unread" data-toggle="tooltip" title="Check Mail"><a data-toggle="tab" data-target="#emailmenu"> <i class="fa fa-globe"></i></a></li> -->
                    <li class="tooltips" data-toggle="tooltip" title="Contacts"><a :href="`https://cryptotraderslab.com/user/profile`"><i class="fa fa-user"></i></a></li>
                   <!-- <li class="tooltips" data-toggle="tooltip" title="Settings"><a data-toggle="tab" data-target="#settings"><i class="fa fa-cog"></i></a></li> -->
                    <li class="tooltips" data-toggle="tooltip" title="Log Out"><a :href="`https://cryptotraderslab.com/logout`"><i class="fa fa-sign-out"></i></a></li>
                </ul>

                <div class="tab-content">

                    <!-- ################# MAIN MENU ################### -->

                    <div class="tab-pane active" id="mainmenu" v-if="authUser.role_id == 1">
                        <h5 class="sidebar-title">Favorites</h5>
                        <ul class="nav nav-pills nav-stacked nav-quirk">
                            <li><a :href="`https://cryptotraderslab.com/user/dashboard`"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/user/transactions`"><i class="fa fa-exchange"></i> <span>Transactions</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/user/add-fund`"><i class="fa fa-money"></i> <span>Deposit Fund</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/user/withdraw-fund`"><i class="fa fa-bitcoin"></i> <span>Withdraw Fund</span></a></li>
                          <!--  <li class="nav-parent">
                                <a href=""><i class="fa fa-check-square"></i> <span>Fund</span></a>
                                <ul class="children">
                                    <li><a :href="'/user/add-fund'">Deposit</a></li>
                                    <li><a :href="'/user/withdraw-fund'">Withdraw</a></li>
                                </ul>
                            </li>-->
                            <li><a :href="`https://cryptotraderslab.com/user/referral`"><i class="fa fa-user-plus"></i> <span>Referrals</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/user/profile`"><i class="fa fa-user"></i> <span>Profile</span></a></li>

                            <li><a :href="`https://cryptotraderslab.com/logout`"><i class="fa fa-sign-out"></i><span>Log Out</span></a></li>
                        </ul>
                    </div><!-- tab-pane -->

                    <div class="tab-pane active" id="mainmenu1" v-if="authUser.role_id == 2">
                        <h5 class="sidebar-title">Favorites</h5>
                        <ul class="nav nav-pills nav-stacked nav-quirk">
                            <li><a :href="`https://cryptotraderslab.com/user/dashboard`"><i class="fa fa-home"></i> <span>Admin Dashboard</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/user/admin-transactions`"><i class="fa fa-exchange"></i> <span>All Transactions</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/user/admin-withdrawals`"><i class="fa fa-bitcoin"></i> <span>All Withdrawals</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/user/create-announcement`"><i class="fa fa-bullhorn"></i><span>Announcements</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/user/fund-users`"><i class="fa fa-exchange"></i> <span>Funding</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/user/withdraw-fund`"><i class="fa fa-bitcoin"></i> <span>Withdraw Fund</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/user/profile`"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/user/manage-users`"><i class="fa fa-user"></i> <span>Manage Users</span></a></li>
                            <li><a :href="`https://cryptotraderslab.com/logout`"><i class="fa fa-sign-out"></i><span>Log Out</span></a></li>
                        </ul>
                    </div><!-- tab-pane -->

                    <!-- ######################## EMAIL MENU ##################### -->



                    <!-- ################### CONTACT LIST ################### -->


                    <!-- #################### SETTINGS ################### -->

                   <!-- <div class="tab-pane" id="settings">
                        <h5 class="sidebar-title">General Settings</h5>
                        <ul class="list-group list-group-settings">
                            <li class="list-group-item">
                                <h5>Daily Newsletter</h5>
                                <small>Get notified when someone else is trying to access your account.</small>
                                <div class="toggle-wrapper">
                                    <div class="leftpanel-toggle toggle-light success"></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <h5>Call Phones</h5>
                                <small>Make calls to friends and family right from your account.</small>
                                <div class="toggle-wrapper">
                                    <div class="leftpanel-toggle-off toggle-light success"></div>
                                </div>
                            </li>
                        </ul>
                        <h5 class="sidebar-title">Security Settings</h5>
                        <ul class="list-group list-group-settings">
                            <li class="list-group-item">
                                <h5>Login Notifications</h5>
                                <small>Get notified when someone else is trying to access your account.</small>
                                <div class="toggle-wrapper">
                                    <div class="leftpanel-toggle toggle-light success"></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <h5>Phone Approvals</h5>
                                <small>Use your phone when login as an extra layer of security.</small>
                                <div class="toggle-wrapper">
                                    <div class="leftpanel-toggle toggle-light success"></div>
                                </div>
                            </li>
                        </ul>
                    </div>&lt;!&ndash; tab-pane &ndash;&gt;
-->

                </div><!-- tab-content -->

            </div><!-- leftpanelinner -->
        </div><!-- leftpanel -->

    </div>
</template>

<script>
    import {getUser} from '../utilities/settings'
    export default {
        data() {
            return {
                authUser: {}
            }
        },
        created() {
          this.getUser();
        },
        methods: {
            getUser() {
                this.$http.get(getUser).then(function (response) {
                    this.authUser = response.body;
                })
                    .catch( (err) => {
                        console.log(err)
                    });
            }
        }
    }
</script>