<template>
    <div>
        <header-up></header-up>
        <section>
            <left-nav></left-nav>

            <div class="mainpanel">

                <div class="contentpanel">

                    <div class="row profile-wrapper">
                        <div class="col-xs-12 col-md-3 col-lg-2 profile-left">
                            <div class="profile-left-heading">
                                <ul class="panel-options">
                                    <li><a><i class="glyphicon glyphicon-option-vertical"></i></a></li>
                                </ul>
                                <a href="" class="profile-photo"><img class="img-circle img-responsive" :src="`https://cryptotraderslab.com/public/images/find_user.png`" alt="" v-if="authUser.pro_pic == ''"></a>
                                <a href="" class="profile-photo"><img class="img-circle img-responsive" :src="`https://cryptotraderslab.com/public/alex_images/` + authUser.pro_pic" alt="" v-if="authUser.pro_pic != null"></a>
                                <h2 class="profile-name">{{ authUser.full_name }}</h2>
                            </div>
                            <div class="profile-left-body">
                                <div class="alert alert-success" v-if="submit">
                                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
                                    Profile Picture Uploaded
                                </div>
                               <form enctype="multipart/form-data" @submit.prevent="updateProfilePicture()" @keydown="clear($event.target.name)">
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="image" @change="onFileChange">  <br>
                                        <input type="hidden" name="id" v-model="authUser.id">
                                        <p class="help is-danger" style="color:red;">{{ getError('image') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success btn-quirk btn-block">Upload</button>
                                    </div>
                                </form>
                                <hr class="fadeout">

                                <h4 class="panel-title">Location</h4>
                                <p><i class="fa fa-map-marker margin-r-5"></i>{{ authUser.country }}</p>

                                <hr class="fadeout">

                                <h4 class="panel-title">Mobile</h4>
                                <p><i class="fa fa-phone"></i>{{ authUser.phone }}</p>

                                <hr class="fadeout">

                                <h4 class="panel-title">Social</h4>
                                <ul class="list-inline profile-social">
                                    <li><a href=""><i class="fa fa-facebook-official"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-8 profile-right">
                            <div class="profile-right-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified nav-line">
                                    <li class="active"><a href="" data-toggle="tab"><strong>Edit Profile</strong></a></li>
                                 
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="activity">

                                        <div class="panel panel-post-item">

                                            <div class="panel-body nopaddingbottom">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <img src="">
                                                    </div>
                                                    <div>
                                                        <div class="alert alert-success" v-if="submitted">
                                                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
                                                            Profile Update is Successful
                                                        </div>
                                                        <form @submit.prevent="updateProfile" @keydown="clear($event.target.name)">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="full_name" v-model="authUser.full_name">
                                                                <p class="help is-danger" style="color:red;">{{ getError('full_name') }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="username" v-model="authUser.username">
                                                                <p class="help is-danger" style="color:red;">{{ getError('username') }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="email" class="form-control" name="email" v-model="authUser.email">
                                                                <p class="help is-danger" style="color:red;">{{ getError('email') }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="phone" v-model="authUser.phone">
                                                                <p class="help is-danger" style="color:red;">{{ getError('phone') }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="bitcoin" v-model="authUser.bitcoin">
                                                                <p class="help is-danger" style="color:red;">{{ getError('bitcoin') }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="country"  class="form-control" v-model="authUser.country">
                                                                    <option value="Afghanistan">Afghanistan</option>
                                                                    <option value="Albania">Albania</option>
                                                                    <option value="Algeria">Algeria</option>
                                                                    <option value="American Samoa">American Samoa</option>
                                                                    <option value="Andorra">Andorra</option>
                                                                    <option value="Angola">Angola</option>
                                                                    <option value="Anguilla">Anguilla</option>
                                                                    <option value="Antartica">Antarctica</option>
                                                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                    <option value="Argentina">Argentina</option>
                                                                    <option value="Armenia">Armenia</option>
                                                                    <option value="Aruba">Aruba</option>
                                                                    <option value="Australia">Australia</option>
                                                                    <option value="Austria">Austria</option>
                                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                                    <option value="Bahamas">Bahamas</option>
                                                                    <option value="Bahrain">Bahrain</option>
                                                                    <option value="Bangladesh">Bangladesh</option>
                                                                    <option value="Barbados">Barbados</option>
                                                                    <option value="Belarus">Belarus</option>
                                                                    <option value="Belgium">Belgium</option>
                                                                    <option value="Belize">Belize</option>
                                                                    <option value="Benin">Benin</option>
                                                                    <option value="Bermuda">Bermuda</option>
                                                                    <option value="Bhutan">Bhutan</option>
                                                                    <option value="Bolivia">Bolivia</option>
                                                                    <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                                                                    <option value="Botswana">Botswana</option>
                                                                    <option value="Bouvet Island">Bouvet Island</option>
                                                                    <option value="Brazil">Brazil</option>
                                                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                                    <option value="Bulgaria">Bulgaria</option>
                                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                                    <option value="Burundi">Burundi</option>
                                                                    <option value="Cambodia">Cambodia</option>
                                                                    <option value="Cameroon">Cameroon</option>
                                                                    <option value="Canada">Canada</option>
                                                                    <option value="Cape Verde">Cape Verde</option>
                                                                    <option value="Cayman Islands">Cayman Islands</option>
                                                                    <option value="Central African Republic">Central African Republic</option>
                                                                    <option value="Chad">Chad</option>
                                                                    <option value="Chile">Chile</option>
                                                                    <option value="China">China</option>
                                                                    <option value="Christmas Island">Christmas Island</option>
                                                                    <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                                                                    <option value="Colombia">Colombia</option>
                                                                    <option value="Comoros">Comoros</option>
                                                                    <option value="Congo">Congo</option>
                                                                    <option value="Congo">Congo, the Democratic Republic of the</option>
                                                                    <option value="Cook Islands">Cook Islands</option>
                                                                    <option value="Costa Rica">Costa Rica</option>
                                                                    <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                                                                    <option value="Croatia">Croatia (Hrvatska)</option>
                                                                    <option value="Cuba">Cuba</option>
                                                                    <option value="Cyprus">Cyprus</option>
                                                                    <option value="Czech Republic">Czech Republic</option>
                                                                    <option value="Denmark">Denmark</option>
                                                                    <option value="Djibouti">Djibouti</option>
                                                                    <option value="Dominica">Dominica</option>
                                                                    <option value="Dominican Republic">Dominican Republic</option>
                                                                    <option value="East Timor">East Timor</option>
                                                                    <option value="Ecuador">Ecuador</option>
                                                                    <option value="Egypt">Egypt</option>
                                                                    <option value="El Salvador">El Salvador</option>
                                                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                                    <option value="Eritrea">Eritrea</option>
                                                                    <option value="Estonia">Estonia</option>
                                                                    <option value="Ethiopia">Ethiopia</option>
                                                                    <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                                                                    <option value="Faroe Islands">Faroe Islands</option>
                                                                    <option value="Fiji">Fiji</option>
                                                                    <option value="Finland">Finland</option>
                                                                    <option value="France">France</option>
                                                                    <option value="France Metropolitan">France, Metropolitan</option>
                                                                    <option value="French Guiana">French Guiana</option>
                                                                    <option value="French Polynesia">French Polynesia</option>
                                                                    <option value="French Southern Territories">French Southern Territories</option>
                                                                    <option value="Gabon">Gabon</option>
                                                                    <option value="Gambia">Gambia</option>
                                                                    <option value="Georgia">Georgia</option>
                                                                    <option value="Germany">Germany</option>
                                                                    <option value="Ghana">Ghana</option>
                                                                    <option value="Gibraltar">Gibraltar</option>
                                                                    <option value="Greece">Greece</option>
                                                                    <option value="Greenland">Greenland</option>
                                                                    <option value="Grenada">Grenada</option>
                                                                    <option value="Guadeloupe">Guadeloupe</option>
                                                                    <option value="Guam">Guam</option>
                                                                    <option value="Guatemala">Guatemala</option>
                                                                    <option value="Guinea">Guinea</option>
                                                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                                    <option value="Guyana">Guyana</option>
                                                                    <option value="Haiti">Haiti</option>
                                                                    <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                                                                    <option value="Holy See">Holy See (Vatican City State)</option>
                                                                    <option value="Honduras">Honduras</option>
                                                                    <option value="Hong Kong">Hong Kong</option>
                                                                    <option value="Hungary">Hungary</option>
                                                                    <option value="Iceland">Iceland</option>
                                                                    <option value="India">India</option>
                                                                    <option value="Indonesia">Indonesia</option>
                                                                    <option value="Iran">Iran (Islamic Republic of)</option>
                                                                    <option value="Iraq">Iraq</option>
                                                                    <option value="Ireland">Ireland</option>
                                                                    <option value="Israel">Israel</option>
                                                                    <option value="Italy">Italy</option>
                                                                    <option value="Jamaica">Jamaica</option>
                                                                    <option value="Japan">Japan</option>
                                                                    <option value="Jordan">Jordan</option>
                                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                                    <option value="Kenya">Kenya</option>
                                                                    <option value="Kiribati">Kiribati</option>
                                                                    <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                                                                    <option value="Korea">Korea, Republic of</option>
                                                                    <option value="Kuwait">Kuwait</option>
                                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                    <option value="Lao">Lao People's Democratic Republic</option>
                                                                    <option value="Latvia">Latvia</option>
                                                                    <option value="Lebanon">Lebanon</option>
                                                                    <option value="Lesotho">Lesotho</option>
                                                                    <option value="Liberia">Liberia</option>
                                                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                                    <option value="Lithuania">Lithuania</option>
                                                                    <option value="Luxembourg">Luxembourg</option>
                                                                    <option value="Macau">Macau</option>
                                                                    <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                                                                    <option value="Madagascar">Madagascar</option>
                                                                    <option value="Malawi">Malawi</option>
                                                                    <option value="Malaysia">Malaysia</option>
                                                                    <option value="Maldives">Maldives</option>
                                                                    <option value="Mali">Mali</option>
                                                                    <option value="Malta">Malta</option>
                                                                    <option value="Marshall Islands">Marshall Islands</option>
                                                                    <option value="Martinique">Martinique</option>
                                                                    <option value="Mauritania">Mauritania</option>
                                                                    <option value="Mauritius">Mauritius</option>
                                                                    <option value="Mayotte">Mayotte</option>
                                                                    <option value="Mexico">Mexico</option>
                                                                    <option value="Micronesia">Micronesia, Federated States of</option>
                                                                    <option value="Moldova">Moldova, Republic of</option>
                                                                    <option value="Monaco">Monaco</option>
                                                                    <option value="Mongolia">Mongolia</option>
                                                                    <option value="Montserrat">Montserrat</option>
                                                                    <option value="Morocco">Morocco</option>
                                                                    <option value="Mozambique">Mozambique</option>
                                                                    <option value="Myanmar">Myanmar</option>
                                                                    <option value="Namibia">Namibia</option>
                                                                    <option value="Nauru">Nauru</option>
                                                                    <option value="Nepal">Nepal</option>
                                                                    <option value="Netherlands">Netherlands</option>
                                                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                                    <option value="New Caledonia">New Caledonia</option>
                                                                    <option value="New Zealand">New Zealand</option>
                                                                    <option value="Nicaragua">Nicaragua</option>
                                                                    <option value="Niger">Niger</option>
                                                                    <option value="Nigeria">Nigeria</option>
                                                                    <option value="Niue">Niue</option>
                                                                    <option value="Norfolk Island">Norfolk Island</option>
                                                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                    <option value="Norway">Norway</option>
                                                                    <option value="Oman">Oman</option>
                                                                    <option value="Pakistan">Pakistan</option>
                                                                    <option value="Palau">Palau</option>
                                                                    <option value="Panama">Panama</option>
                                                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                                                    <option value="Paraguay">Paraguay</option>
                                                                    <option value="Peru">Peru</option>
                                                                    <option value="Philippines">Philippines</option>
                                                                    <option value="Pitcairn">Pitcairn</option>
                                                                    <option value="Poland">Poland</option>
                                                                    <option value="Portugal">Portugal</option>
                                                                    <option value="Puerto Rico">Puerto Rico</option>
                                                                    <option value="Qatar">Qatar</option>
                                                                    <option value="Reunion">Reunion</option>
                                                                    <option value="Romania">Romania</option>
                                                                    <option value="Russia">Russian Federation</option>
                                                                    <option value="Rwanda">Rwanda</option>
                                                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                    <option value="Saint LUCIA">Saint LUCIA</option>
                                                                    <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                                                                    <option value="Samoa">Samoa</option>
                                                                    <option value="San Marino">San Marino</option>
                                                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                                    <option value="Senegal">Senegal</option>
                                                                    <option value="Seychelles">Seychelles</option>
                                                                    <option value="Sierra">Sierra Leone</option>
                                                                    <option value="Singapore">Singapore</option>
                                                                    <option value="Slovakia">Slovakia (Slovak Republic)</option>
                                                                    <option value="Slovenia">Slovenia</option>
                                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                                    <option value="Somalia">Somalia</option>
                                                                    <option value="South Africa">South Africa</option>
                                                                    <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                                                                    <option value="Span">Spain</option>
                                                                    <option value="SriLanka">Sri Lanka</option>
                                                                    <option value="St. Helena">St. Helena</option>
                                                                    <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                                                                    <option value="Sudan">Sudan</option>
                                                                    <option value="Suriname">Suriname</option>
                                                                    <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                                                                    <option value="Swaziland">Swaziland</option>
                                                                    <option value="Sweden">Sweden</option>
                                                                    <option value="Switzerland">Switzerland</option>
                                                                    <option value="Syria">Syrian Arab Republic</option>
                                                                    <option value="Taiwan">Taiwan, Province of China</option>
                                                                    <option value="Tajikistan">Tajikistan</option>
                                                                    <option value="Tanzania">Tanzania, United Republic of</option>
                                                                    <option value="Thailand">Thailand</option>
                                                                    <option value="Togo">Togo</option>
                                                                    <option value="Tokelau">Tokelau</option>
                                                                    <option value="Tonga">Tonga</option>
                                                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                    <option value="Tunisia">Tunisia</option>
                                                                    <option value="Turkey">Turkey</option>
                                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                                    <option value="Turks and Caicos">Turks and Caicos Islands</option>
                                                                    <option value="Tuvalu">Tuvalu</option>
                                                                    <option value="Uganda">Uganda</option>
                                                                    <option value="Ukraine">Ukraine</option>
                                                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                                                    <option value="United Kingdom">United Kingdom</option>
                                                                    <option value="United States" selected="">United States</option>
                                                                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                                    <option value="Uruguay">Uruguay</option>
                                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                                    <option value="Vanuatu">Vanuatu</option>
                                                                    <option value="Venezuela">Venezuela</option>
                                                                    <option value="Vietnam">Viet Nam</option>
                                                                    <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                                                    <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                                                                    <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                                                                    <option value="Western Sahara">Western Sahara</option>
                                                                    <option value="Yemen">Yemen</option>
                                                                    <option value="Yugoslavia">Yugoslavia</option>
                                                                    <option value="Zambia">Zambia</option>
                                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                                </select>
                                                                <p class="help is-danger" style="color:red;">{{ getError('country') }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="city" v-model="authUser.city">
                                                                <p class="help is-danger" style="color:red;">{{ getError('city') }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="state" v-model="authUser.state">
                                                                <p class="help is-danger" style="color:red;">{{ getError('state') }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <button class="btn btn-success btn-quirk btn-block">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div><!-- panel-body -->
                                        </div><!-- panel panel-post -->

                                    </div><!-- tab-pane -->

                                    <div class="tab-pane" id="photos">
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    </div>
                                    <div class="tab-pane" id="music">
                                        Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-2 profile-sidebar">
                            <div class="row">
                                <div class="col-sm-6 col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Referral List</h4>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="media-list user-list" v-for="ref in referrals">
                                                <li class="media">{{ ref.full_name }}</li>
                                                <a href="#">
                                                    <img class="media-object img-circle" :src="`https://cryptotraderslab.com/public/alex_images/` + ref.pro_pic" alt="">
                                                </a>
                                            </ul>
                                            <span v-if="referrals && referrals.length === 0">
                                            <center class="text-center">No referral Yet.</center>
                                            </span>
                                        </div>
                                        <div class="paginationn float-right" v-if="referrals && referrals.length !== 0">
                                            <button class="btn btn-default btn-sm" @click="myReferrals(pagination.prev_page_url)"
                                                    :disabled="!pagination.prev_page_url">
                                                Previous
                                            </button> &nbsp;
                                            <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span> &nbsp;
                                            <button class="btn btn-default btn-sm" @click="myReferrals(pagination.next_page_url)"
                                                    :disabled="!pagination.next_page_url">Next
                                            </button>
                                        </div>
                                    </div><!-- panel -->
                                </div>
                                <div class="col-sm-6 col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">Announcements</h4>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="media-list user-list" v-for="announcement in announcements">
                                                <li class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object img-circle" src="" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading nomargin"><a href="#">{{ announcement.content }}...</a></h4>
                                                        <small>{{ announcement.created_at | formatDate}} <a href="#">Admin</a></small>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- panel -->
                                    <div class="panel-footer">
                                        <button class="btn btn-primary btn-block" @click="getAnnouncements(pagination.prev_page_url)"
                                                :disabled="!pagination.prev_page_url"><i class="fa fa-arrow-left"></i>Previous</button>
                                        <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
                                        <button class="btn btn-primary btn-block" @click="getAnnouncements(pagination.next_page_url)"
                                                :disabled="!pagination.next_page_url">Next<i class="fa fa-arrow-right"></i></button>

                                    </div>
                                </div>
                            </div><!-- row -->

                        </div>
                    </div><!-- row -->

                </div><!-- contentpanel -->
            </div><!-- mainpanel -->

        </section>
    </div>
</template>

<script>
    import leftNav from '../components/leftNav.vue'
    import Header from '../components/Header.vue'
    import {getUser} from '../utilities/settings'
    import {updateProfile} from '../utilities/settings'
    import {updateProfilePicture} from '../utilities/settings'
    import {myReferrals} from '../utilities/settings'
    import {getAnnouncement} from '../utilities/settings'
    export default {
        data() {
            return {
                uploading:false,
                pagination: {},
                announcements: {},
                errors: {},
                submitted:false,
                submit:false,
                authUser: {},
                referrals: {},
                image: '',
            }
        },
        components: {
            'left-nav' : leftNav,
            'header-up': Header
        },
        created() {
            this.getUser();
            this.myReferrals();
            this.getAnnouncements();
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
            updateProfile() {
                this.$http.post(updateProfile, this.authUser)
                    .then(function (response) {
                        this.submitted = true;
                        // this.authUser = ""
                    })
                    .catch( (err) => {
                        this.submitted = false;
                        this.errors = err.body.errors || err.body;
                    })
            },
              updateProfilePicture() {
               this.$http.post(updateProfilePicture, {image: this.image})
                   .then(function (response) {
                       this.submit = true;
                       window.location = 'https://cryptotraderslab.com/user/profile'
                   })
                   .catch( (err) => {
                       this.submit = false;
                       this.errors = err.body.errors || err.body;
                   })
           },
            myReferrals(page_url) {

                page_url = page_url || myReferrals
                this.$http.get(page_url).then((response) => {
                    this.makePagination(response.data)
                    this.referrals = response.data.data;
                });

            },

            makePagination (data) {
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url,
                    total: data.total
                }
                this.pagination = pagination;
            },
            getAnnouncements(page_url) {

                page_url = page_url || getAnnouncement
                this.$http.get(page_url).then((response) => {
                    this.makePagination(response.data)
                    this.announcements = response.data.data;
                });

            },

            makePagination (data) {
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url,
                    total: data.total
                }
                this.pagination = pagination;
            },

            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
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