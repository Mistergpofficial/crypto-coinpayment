<template>
    <div>
        <div class="sign-overlay"></div>
        <div class="signpanel"></div>

        <div class="signup">
            <div class="row">
                <div class="col-sm-5">
                    <div class="panel">
                        <div class="panel-heading">
                            <h1><a :href="`https://cryptotraderslab.com`">Crypto Traders Lab</a></h1>
                            <h4 class="panel-title">Create an Account Admin!</h4>
                        </div>
                        <div class="panel-body">
                            <!--  <button class="btn btn-primary btn-quirk btn-fb btn-block">Sign Up Using Facebook</button>
                              <div class="or">or</div>-->
                            <div class="alert alert-success" v-if="submitted">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
                                Registration is Successful
                            </div>
                            <form @submit.prevent="adminSignup()" @keydown="clear($event.target.name)">
                                <div class="form-group mb15">
                                    <input type="text" name="full_name" v-model="adminSignupData.full_name" class="form-control" placeholder="Enter Your Full Name">
                                    <p class="help is-danger" style="color: red;">{{ getAdminSignupError('full_name') }}</p>
                                </div>
                                <div class="form-group mb15">
                                    <input type="text" name="username" v-model="adminSignupData.username" class="form-control" placeholder="Enter Your Username">
                                    <p class="help is-danger" style="color: red;">{{ getAdminSignupError('username') }}</p>
                                </div>
                                <div class="form-group mb15">
                                    <input type="email" name="email" v-model="adminSignupData.email" class="form-control" placeholder="Enter Your Email">
                                    <p class="help is-danger" style="color: red;">{{ getAdminSignupError('email') }}</p>
                                </div>
                                <div class="form-group mb15">
                                    <input type="password" name="password" v-model="adminSignupData.password" class="form-control" placeholder="Enter Your Password">
                                    <p class="help is-danger" style="color: red;">{{ getAdminSignupError('password') }}</p>
                                </div>
                                <div class="form-group mb15">
                                    <input type="password" name="password_confirmation" v-model="adminSignupData.password_confirmation" class="form-control" placeholder="Enter Your Password Again">
                                    <p class="help is-danger" style="color: red;">{{ getAdminSignupError('password_confirmation') }}</p>
                                </div>
                                <div class="form-group mb15">
                                    <input type="text" name="bitcoin" v-model="adminSignupData.bitcoin" class="form-control" placeholder="Enter Your Bitcoin Wallet">
                                    <p class="help is-danger" style="color: red;">{{ getAdminSignupError('bitcoin') }}</p>
                                </div>

                                <div class="form-group mb15">
                                    <input type="text" name="phone" v-model="adminSignupData.phone" class="form-control" placeholder="Enter Your Phone Number">
                                    <p class="help is-danger" style="color: red;">{{ getAdminSignupError('phone') }}</p>
                                </div>


                                <div class="form-group mb20">
                                    <label class="ckbox">
                                        <input type="checkbox" name="checkbox" checked>
                                        <span>Accept terms and conditions</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success btn-quirk btn-block" :class="[ (signingUp)?  'is-loading' : '' ]">Create Account</button>
                                </div>
                            </form>
                        </div><!-- panel-body -->
                    </div><!-- panel -->
                </div><!-- col-sm-5 -->
                <div class="col-sm-7">
                     <div class="sign-sidebar">

                        <img :src="`https://cryptotraderslab.com/public/images/01.jpg`" />
                        <hr class="invisible">

                        <div class="form-group">
                            <a :href="`https://cryptotraderslab.com/auth/login`" class="btn btn-default btn-quirk btn-stroke btn-stroke-thin btn-block btn-sign">Already a member? Sign In Now!</a>
                        </div>
                    </div><!-- sign-sidebar -->
                </div>
            </div>
        </div><!-- signup -->

    </div>
</template>

<script>
    export default {
        data () {
            return {
                signingUp : false ,
                submitted: false,
                errors: {},
                adminSignupData : {
                    full_name: '',
                    username: '',
                    email : '',
                    password : '',
                    password_confirmation : '',
                    bitcoin : '',
                    phone: ''

                },
            }
        },
        methods: {
            adminSignup(){

                this.signingUp = true ;
                // console.log(this.signingUp);
                // Make a post request for a user to login
                this.$http.post(  `${Laravel.appUrl}/admin-register/post-werbrtyrsequew/ntui` , this.adminSignupData)
                    .then(function (response) {
                        // console.log(response);
                        $('button').text('signing up ...');
                        this.submitted = true;
                        this.adminSignupData = "";
                        //window.location = Laravel.appUrl;
                    })
                    .catch( (error) =>  {
                        // console.log(error);
                        this.signingUp = false ;
                        this.submitted = false;
                        this.errors = error.body.errors || error.body ;

                    });
            },
            getAdminSignupError(field){

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
            },


        }
    }
</script>