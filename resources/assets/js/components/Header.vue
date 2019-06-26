<template>
    <div>
        <header>
            <div class="headerpanel">

                <div class="logopanel">
                    <h2><a href=""><img :src="`https://cryptotraderslab.com/public/images/logo-white.png`" width="180px"></a></h2>
                </div><!-- logopanel -->

                <div class="headerbar">

                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

                    <div class="searchpanel">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>

                        </div><!-- input-group -->
                    </div><!-- searchpanel -->
                    <Notification v-bind:notifications="notifications"></Notification>
                </div><!-- headerbar -->
            </div><!-- header-->
        </header>
    </div>
</template>


<script>
    import {getUser} from '../utilities/settings'
    import {allNotifications} from '../utilities/settings'
    import {markAsRead} from '../utilities/settings'
    import {allNotificationsCount} from '../utilities/settings'
    export default {
        data() {
            return {
                authUser: {},
                notifications: {},
                notificationsCount: {}
            }
        },
        created() {
            this.getUser();
            this.getNotifications();
            this.getNotificationsCount();
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
            getNotifications() {
                this.$http.get(allNotifications).then(function (response) {
                    this.notifications = response.body;
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
                    window.location.href = "https://cryptotraderslab.com/user/dashboard/";
                })
            }
        }
    }
</script>