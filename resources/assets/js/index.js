/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 import Vue2Filters from 'vue2-filters'

import {getUser} from "./utilities/settings"
import {allNotifications} from "./utilities/settings"
import {coinpayment} from "./utilities/settings"
import {withdraw_amt} from "./utilities/settings"
import {withdraw_referral_amt} from "./utilities/settings"
import {clientWithdrawal} from "./utilities/settings"
import Header from './components/Header.vue'
Vue.component('Dashboard', require('./components/Dashboard.vue'));
Vue.component('Profile', require('./components/Profile.vue'));
Vue.component('Referral', require('./components/Referral.vue'));
Vue.component('Fund', require('./components/AddFund.vue'));
Vue.component('Notification', require('./components/Notification.vue'));
Vue.component('Left', require('./components/leftNav.vue'));
Vue.component('Headers', require('./components/Header.vue'));
Vue.component('Announcement', require('./components/CreateAnnouncement.vue'));
Vue.component('Transactions', require('./components/Transactions.vue'));
Vue.component('Transaction', require('./components/AdminTransactions.vue'));
Vue.filter('formatDate', function (value) {
    if(value) {
        return moment(String(value)).format('Do/MMMM/YYYY hh:mm')
    }
});
Vue.filter('round', function (value, decimals) {
    if(!value) {
        value = 0;
    }
    if(!decimals) {
        decimals = 0;
    }

    value = Math.round(value * Math.pow(10, decimals)) / Math.pow(10, decimals);
        return value;
});
let UPDATE_INTERVAL = 60 * 1000;

const index = new Vue({
    el: '#index',
    data: () => ({
       // cryptos: [],
         pagination: {},
        authUser: {},
        transaction: {},
        errors: {},
        notifications: '',
        submitted: false,
        withdraw_amt: {},
        withdraw_ref_amt: {},
        withdrawal: {},
        coinsBtc: {},
        newDepositForm: false,
        newWithdrawalForm: false,
        investmentDetails: {
            currency: '',
            amount: '',
            amount_btc: '',
            buyer_name: '',
            buyer_email: '',
            id: ''
        },
    /*    validation: {
            amount: {
                is_valid: true,
                text: ''
            }
        },*/
        withdrawalDetails: {
            amount: '',
            total: 'total'
        },
        validation: {
            amount: {
                is_valid: true,
                text: ''
            }
        },
        withdrawalReferralDetails: {
            amount: '',
            referral: 'referral'
        },
        validations: {
            amount: {
                is_valid: true,
                text: ''
            }
        },
    }),
    computed: {
        result: function () {
            return this.investmentDetails.amount / this.coinsBtc[0].price_usd;
        }
    },
            created() {
                    this.$http.get(getUser).then(function (response) {
                        this.authUser = response.body;
                    });
                    this.$http.get(allNotifications).then(response => {
                        this.notifications = response.body;
                    });
                this.$http.post(coinpayment).then(response => {
                    this.transaction = response.body;
                });
                this.withdrawAmt();
                this.withdrawReferralAmt();
                this.fetchWithdrawal();
               this.getCoinsBtc();
              /*  Echo.private('App.User.' + Laravel.siteUser.id).notification((notification) => {
                     this.notifications.push(notification);
                    //console.log(notification)
                });*/
            },
        methods: {
            validateMinimumAmount(){
                let validNewMinimumAmount = true;

                if(this.investmentDetails.amount < 5000 ){
                    validNewMinimumAmount = false;
                    this.validation.amount.is_valid = false;
                    this.validation.amount.text = 'Minimum deposit is from $5000'
                }else {
                    this.validation.amount.is_valid = true;
                    this.validation.amount.text = '';
                }

                return validNewMinimumAmount;
            },
            invest() {
            //   if(this.validateMinimumAmount()) {
                    this.$http.post(coinpayment, this.investmentDetails)
                        .then(function (response) {
                            this.submitted = true;
                            this.investmentDetails = "";

                            window.location = 'https://cryptotraderslab.com/user/add-fund/checkout'
                        })
                        .catch((error) => {
                            this.submitted = false;
                            this.errors = error.body.errors || error.body;

                        });
               // }
            },
            validateAmount(){
                let validNewAmount = true;
                if(this.withdrawalDetails.amount > this.withdraw_amt.sum){
                    validNewAmount = false;
                    this.validations.amount.is_valid = false;
                    this.validations.amount.text = 'You have exceeded your total balance'
                }else{
                    this.validations.amount.is_valid = true;
                    this.validations.amount.text = '';
                }

                return validNewAmount;
            },
            withdraw() {
                if(this.validateAmount()) {
                    this.$http.post(`${Laravel.appUrl}/user/post-withdraw`, this.withdrawalDetails)
                        .then(function (response) {
                            this.submitted = true;
                            this.withdrawalDetails = ""
                            window.location = `${Laravel.appUrl}/user/withdraw-fund`
                        })
                        .catch((err) => {
                            this.errors = err.body.errors;
                        })
                }
            },
            validateReferralAmount(){
                let validNewReferralAmount = true;
                    if(this.withdrawalReferralDetails.amount > this.withdraw_ref_amt.ref){
                    validNewReferralAmount = false;
                    this.validations.amount.is_valid = false;
                    this.validations.amount.text = 'Amount given has exceeded available referral balance'
                }else {
                    this.validations.amount.is_valid = true;
                    this.validations.amount.text = '';
                }

                return validNewReferralAmount;
            },


            withdrawReferral() {
               if(this.validateReferralAmount()) {
                    this.$http.post(`${Laravel.appUrl}/user/post-referral-withdraw`, this.withdrawalReferralDetails)
                        .then(function (response) {
                            this.submitted = true;
                            this.withdrawalReferralDetails = ""
                            window.location = `${Laravel.appUrl}/user/withdraw-fund`

                            // window.location = `${Laravel.appUrl}/user/withdraw`
                        })
                        .catch((err) => {
                            this.errors = err.body.errors;
                        })
               }
            },
            withdrawAmt(){
                this.$http.get(withdraw_amt)
                    .then(function (response) {
                        this.withdraw_amt = response.body;
                    })
                    .catch( (err) => {
                        console.log(err)
                    })
            },

            withdrawReferralAmt(){
                this.$http.get(withdraw_referral_amt)
                    .then(function (response) {
                        this.withdraw_ref_amt = response.body;
                    })
                    .catch( (err) => {
                        console.log(err)
                    })
            },
           
            fetchWithdrawal(page_url) {

                page_url = page_url || clientWithdrawal
                this.$http.get(page_url).then((response) => {
                    this.makePagination(response.data)
                    this.withdrawal = response.data.data;
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

              turnFilter: function () {

            let keep = this.filterParams;
            if (keep) {
                this.filterParams = false;
            }
            else if (!keep) {
                this.filterParams = true;
            }
        },


            getWithdrawalError(field){

                if (this.errors.hasOwnProperty(field) ) {



                    if (typeof this.errors[field] === "object") {

                        return this.errors[field][0];
                    }

                    if ( typeof this.errors[field] === "string" ) {

                        return this.errors[field]
                    }
                }

            },

            getWithdrawalReferralError(field){

                if (this.errors.hasOwnProperty(field) ) {

                    if (typeof this.errors[field] === "object") {

                        return this.errors[field][0];
                    }

                    if ( typeof this.errors[field] === "string" ) {

                        return this.errors[field]
                    }
                }

            },

            getInvestmentError(field){

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
            getCoinsBtc: function() {
                let that = this
                $.ajax({
                    url: 'https://api.coinmarketcap.com/v1/ticker/bitcoin/',
                    method: 'GET'
                }).then(function (response) {
                    if (response.error) {
                        console.err("There was an error " + response.error);
                    } else {

                        console.log(response);
                        that.coinsBtc = response
                    }
                }).catch(err => {
                    console.error(err);
                });

            },

        }

});

setInterval(() => {
    this.getCoinsBtc();
}, UPDATE_INTERVAL);

