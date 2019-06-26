<template>
    <div>
        <div class="header-right">
            <ul class="headermenu">
                <li>
                    <div id="noticePanel" class="btn-group">
                        <button class="btn btn-notice alert-notice" data-toggle="dropdown">
                            <i class="fa fa-globe">{{notificationsCount}}</i>
                        </button>
                        <div id="noticeDropdown" class="dropdown-menu dm-notice pull-right">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                    <li class="active"><a data-target="#notification" data-toggle="tab">Notifications ({{notificationsCount}})</a></li>
                                    <!--   <li><a data-target="#reminders" data-toggle="tab">Reminders (4)</a></li>-->
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="notification">
                                        <ul class="list-group notice-list">
                                            <li class="list-group-item unread" v-for="notification in notifications">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                    <div class="col-xs-10">
                                                        <h5>Someone just registered with your link<br><a href="#" v-on:click="MarkAsRead(notification)">{{ notification.data.link.address }}</a></h5>
                                                        <small>{{ notification.created_at | formatDate }}</small>
                                                        <!--  <span>Soluta nobis est eligendi optio cumque...</span>-->
                                                    </div>
                                                </div>
                                            </li>
                                            <li v-if="notifications.length == 0">
                                                You have no new notification
                                            </li>
                                        </ul>
                                        <a class="btn-more" href="" v-if="notifications && notifications.length != 0">View More Notifications <i class="fa fa-long-arrow-right"></i></a>
                                    </div><!-- tab-pane -->

                                    <!--         <div role="tabpanel" class="tab-pane" id="reminders">
                                                 <h1 id="todayDay" class="today-day">Friday</h1>
                                                 <h3 id="todayDate" class="today-date">16th February 2018</h3>

                                                 <h5 class="today-weather"><i class="wi wi-hail"></i> Cloudy 77 Degree</h5>
                                                 <p>Thunderstorm in the area this afternoon through this evening</p>

                                                 <h4 class="panel-title">Upcoming Events</h4>
                                                 <ul class="list-group">
                                                     <li class="list-group-item">
                                                         <div class="row">
                                                             <div class="col-xs-2">
                                                                 <h4>20</h4>
                                                                 <p>Aug</p>
                                                             </div>
                                                             <div class="col-xs-10">
                                                                 <h5><a href="">HTML5/CSS3 Live! United States</a></h5>
                                                                 <small>San Francisco, CA</small>
                                                             </div>
                                                         </div>
                                                     </li>
                                                     <li class="list-group-item">
                                                         <div class="row">
                                                             <div class="col-xs-2">
                                                                 <h4>05</h4>
                                                                 <p>Sep</p>
                                                             </div>
                                                             <div class="col-xs-10">
                                                                 <h5><a href="">Web Technology Summit</a></h5>
                                                                 <small>Sydney, Australia</small>
                                                             </div>
                                                         </div>
                                                     </li>
                                                     <li class="list-group-item">
                                                         <div class="row">
                                                             <div class="col-xs-2">
                                                                 <h4>25</h4>
                                                                 <p>Sep</p>
                                                             </div>
                                                             <div class="col-xs-10">
                                                                 <h5><a href="">HTML5 Developer Conference 2015</a></h5>
                                                                 <small>Los Angeles CA United States</small>
                                                             </div>
                                                         </div>
                                                     </li>
                                                     <li class="list-group-item">
                                                         <div class="row">
                                                             <div class="col-xs-2">
                                                                 <h4>10</h4>
                                                                 <p>Oct</p>
                                                             </div>
                                                             <div class="col-xs-10">
                                                                 <h5><a href="">AngularJS Conference 2015</a></h5>
                                                                 <small>Silicon Valley CA, United States</small>
                                                             </div>
                                                         </div>
                                                     </li>
                                                 </ul>
                                                 <a class="btn-more" href="">View More Events <i class="fa fa-long-arrow-right"></i></a>
                                             </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="btn-group">
                        <button type="button" class="btn btn-logged" data-toggle="dropdown">
                            <img :src="`https://cryptotraderslab.com/public/images/find_user.png`" alt="" v-if="authUser.pro_pic == ''" alt="">
                            <img :src="`https://cryptotraderslab.com/public/alex_images/` + authUser.pro_pic" alt="" v-if="authUser.pro_pic != null" alt="">
                           {{ authUser.full_name }}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li><a :href="`https://cryptotraderslab.com/user/profile`"><i class="fa fa-user"></i> My Profile</a></li>
                            <li><a :href="`https://cryptotraderslab.com/logout`"><i class="fa fa-sign-out"></i> Log Out</a></li>
                        </ul>
                    </div>
                </li>
               <!-- <li>
                    <button id="chatview" class="btn btn-chat alert-notice">
                        <span class="badge-alert"></span>
                        <i class="fa fa-comments-o"></i>
                    </button>
                </li>-->
            </ul>
        </div><!-- header-right -->
    </div>
</template>

<script>
    import {markAsRead} from '../utilities/settings'
   import {getUser} from '../utilities/settings'
    import {allNotificationsCount} from '../utilities/settings'
    export default {
        props: ['notifications'],
        data() {
            return {
                authUser: {},
                notificationsCount: {}
            }
        },
        created() {
         //   this.getNotifications();
            this.getNotificationsCount();
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
            },
            getNotificationsCount() {
                this.$http.get(allNotificationsCount).then(function (response) {
                    this.notificationsCount = response.body;
                })
                    .catch( (err) => {
                        console.log(err)
                    });
            },
            MarkAsRead: function(notification) {
                let data = {
                    id: notification.id
                };
                this.$http.post(markAsRead, data).then(response => {
                    window.location.href = "https://cryptotraderslab.com/user/dashboard";
                })
            }
        }
    }
</script>