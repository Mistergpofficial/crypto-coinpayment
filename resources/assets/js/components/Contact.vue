<template>
    <div>
        <div class="clearfix"></div>
        <!--======= Breadcrumb Inner Page =======-->
        <section class="iq-bg iq-bg-fixed iq-over-black-70 jarallax iq-breadcrumb text-center iq-font-white" style="background-image: none; background-position: center; background-image: url('images/4.jpg'); background-position: center;">
        <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="heading-title iq-mb-25">
                            <h3 class="title text-uppercase iq-font-white iq-tw-6">Contact Us</h3>
                        </div>
<!--                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>-->
                    </div>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a :href="'/'">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us </li>
                </ol>
            </nav>
            <div id="jarallax-container-0" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; pointer-events: none; z-index: -100;"><div style="background-position: 50% 50%; background-size: cover; background-repeat: no-repeat; background-image: url(&quot;http://iqonicthemes.com/themes/coinex/images/bg/bg-2.jpg&quot;); position: fixed; top: 0px; left: 0px; width: 1349px; height: 580.8px; overflow: hidden; pointer-events: none; margin-top: 16.1px; transform: translate3d(0px, 8.3px, 0px);"></div></div></section>
        <!--======= Breadcrumb Inner Page =======-->
        <!-- Main Content -->
        <div class="main-content">
            <section class="contact-1">
                <div class="container-fluid">
                    <div class="row no-gutter">
                        <div class="col-lg-6 col-md-12">
                            <div class="iq-map">
                                <div class="iq-plr-40 iq-mt-40">
                                    <h2 class="iq-mtb-10">Talk to us!</h2>
                                    <p><i>We are always happy to hear from you! </i></p>
                                    <div class="row iq-mt-30">
                                        <div class="col-sm-12">
                                            <div class="alert alert-success" v-if="submitted">
                                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
                                                Your Message has been sent successfully
                                            </div>
                                            <form @submit.prevent="postContact()" @keydown="clear($event.target.name)" class="form-horizontal">
                                                <div class="contact-form">
                                                    <div class="section-field iq-mb-30">
                                                        <input id="name" type="text" placeholder="Name*" v-model="contactDetails.name" name="name">
                                                        <p class="help is-danger" style="color:red;">{{ getContactError('name') }}</p>
                                                    </div>
                                                    <div class="section-field iq-mb-30">
                                                        <input id="email" type="text" placeholder="Email*" v-model="contactDetails.email" name="email">
                                                        <p class="help is-danger" style="color:red;">{{ getContactError('email') }}</p>
                                                    </div>
                                                    <div class="section-field iq-mb-30">
                                                        <input id="phone" type="text" placeholder="Phone*" v-model="contactDetails.phone" name="phone">
                                                        <p class="help is-danger" style="color:red;">{{ getContactError('phone') }}</p>
                                                    </div>
                                                    <div class="section-field iq-mb-30">
                                                        <input id="subject" type="text" placeholder="Subject*" v-model="contactDetails.subject" name="subject">
                                                        <p class="help is-danger" style="color:red;">{{ getContactError('subject') }}</p>
                                                    </div>
                                                    <div class="section-field iq-mb-30">
                                                        <textarea class="input-message" placeholder="Message*" v-model="contactDetails.message" name="message"></textarea>
                                                        <p class="help is-danger" style="color:red;">{{ getContactError('message') }}</p>
                                                        <button id="submit" name="submit" type="submit" value="Send" class="button pull-right iq-mt-40">Send Message</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div id="ajaxloader" style="display:none"><img class="center-block mt-30 mb-30" src="" alt=""></div>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>
                                </div>
</div>
                        </div>
                        <div class="col-lg-6 col-md-12 iq-help-form">
                          <!--  <div class="iq-plr-40 iq-mt-40">
                                       <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=JoomShaper,+Dhaka,+Dhaka+Division,+Bangladesh&amp;aq=0&amp;oq=joomshaper&amp;sll=37.0625,-95.677068&amp;sspn=42.766543,80.332031&amp;ie=UTF8&amp;hq=JoomShaper,&amp;hnear=Dhaka,+Dhaka+Division,+Bangladesh&amp;ll=23.73854,90.385504&amp;spn=0.001515,0.002452&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=1073661719450182870&amp;output=embed"></iframe>

                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row iq-ptb-80">
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="iq-contact-box-01">
                                <div class="iq-icon dark-bg">
                                    <i aria-hidden="true" class="ion-ios-location-outline"></i>
                                </div>
                                <div class="contact-content">
                                    <h5 class="iq-tw-6">Address</h5>
                                    <span class="lead iq-tw-6">15A MEAN VALLEY GOLDENBANK FALMOUTH. TR11</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="iq-contact-box-01">
                                <div class="iq-icon dark-bg">
                                    <i aria-hidden="true" class="ion-ios-telephone-outline"></i>
                                </div>
                                <div class="contact-content">
                                    <h5 class="iq-tw-6">Social</h5>
                                    <ul class="list-inline profile-social">
                                        <li><a href="https://web.facebook.com/langleyfamily"><i class="fa fa-facebook-official"></i></a></li>
                                        <li><a href="https://web.facebook.com/workwithbeccollier"><i class="fa fa-facebook-official"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="iq-contact-box-01">
                                <div class="iq-icon dark-bg">
                                    <i aria-hidden="true" class="ion-ios-email-outline"></i>
                                </div>
                                <div class="contact-content">
                                    <h5 class="iq-tw-6">Mail</h5>
                                    <span class="lead iq-tw-6">support@cryptotraderslab.com</span>
                                    <span class="lead iq-tw-6">admin@cryptotraderslab.com</span>
                                 <!--   <p class="iq-mb-0">24 X 7 online support</p>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </div>
        </div>
</template>


<script>
    export default {
        data () {
            return {
                contactDetails: {
                    name: '',
                    email: '',
                    phone: '',
                    subject: '',
                    message: ''
                },
                errors: {},
                submitted: false

            }
        },
        methods: {
            postContact() {
                this.$http.post(   `${Laravel.appUrl}/contact` , this.contactDetails)
                    .then(function (response) {
                        this.submitted = true;
                        this.contactDetails = ""
                    })
                    .catch( (err) => {
                        this.errors = err.body.errors;
                    })
            },
            getContactError(field){

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