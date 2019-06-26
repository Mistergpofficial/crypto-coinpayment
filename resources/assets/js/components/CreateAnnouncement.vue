<template>
    <div>
        <header-up></header-up>
        <section>
            <left-nav></left-nav>

            <div class="mainpanel">

                <div class="contentpanel">

                    <ol class="breadcrumb breadcrumb-quirk">
                        <li><a :href="`https://cryptotraderslab.com`"><i class="fa fa-home mr5"></i> Home</a></li>
                        <li><a :href="`https://cryptotraderslab.com/user/create-announcement`">Announcement</a></li>
                    </ol>

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">ANNOUNCEMENT</h4>
                        </div>

                        <div class="panel-body">
                            <div class="alert alert-success" v-if="submitted">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
                               Announcement creatd successfully
                            </div>
                            <form @submit.prevent="postAnnouncement()" @keydown="clear($event.target.name)">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Subject*" name="subject" v-model="announcementData.subject">
                                    <p class="help is-danger" style="color:red;">{{ getError('subject') }}</p>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Message*" name="content" v-model="announcementData.content"></textarea>
                                    <p class="help is-danger" style="color:red;">{{ getError('content') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success btn-quirk btn-block">Create Announcement</button>
                                </div>
                            </form>

                        </div>
                    </div><!-- panel -->


                </div><!-- contentpanel -->
            </div><!-- mainpanel -->

        </section>
    </div>
</template>


<script>
    import leftNav from '../components/leftNav.vue'
    import Header from '../components/Header.vue'
    import {getUser} from '../utilities/settings'
    import {myReferrals} from '../utilities/settings'
    import {myReferralsCount} from '../utilities/settings'
    export default {
        data() {
            return {
                errors: {},
                submitted: false,
                announcementData: {
                    subject: '',
                    content: ''
                }
            }
        },
        components: {
            'left-nav' : leftNav,
            'header-up': Header
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
            },

            postAnnouncement(){
              this.$http.post(  `${Laravel.appUrl}/user/post-create-announcement` , this.announcementData).then(function (response) {
                  this.submitted = true;
                  this.announcementData = "";
              })  .catch( (err) => {
                  this.submitted = false;
                  this.errors = err.body.errors;
              })
            },




            getError(field){

                if (this.errors.hasOwnProperty(field) ) {



                    if (typeof this.errors[field] === "object") {

                        return this.errors[field][0];
                    }

                    if ( typeof this.errors[field] === "string" ) {

                        return this.errors[field]

                    }
                }

            },

            clear(field) {
                delete this.errors[field];
            },

            any() {
                return Object.keys(this.errors).length > 0;
            }
        }
    }
</script>