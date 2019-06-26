<template>
    <div>

        <header-up></header-up>
        <section>
            <left-nav></left-nav>

           <!-- <div class="mainpanel">

                <div class="contentpanel">

                    <ol class="breadcrumb breadcrumb-quirk">
                        <li><a href=""><i class="fa fa-home mr5"></i> Home</a></li>
                        <li><a href="">Add Fund</a></li>
                    </ol>

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">DEPOSIT FORM</h4>
                        </div>

                        <div class="panel-body">
                            &lt;!&ndash; main page starts here &ndash;&gt;
                            <div class="breadcrumb">

                                <li class="breadcrumb-item"><span class="uk-badge"> &nbsp; Total Deposit: &nbsp; </span></li>
                                <li> &nbsp; <button class="newButton breadcrumb-item uk-button uk-button-primary uk-button-small" href="#newDepositForm" uk-scroll @click="newDepositForm = true">Add New Deposit</button></li>

                                &lt;!&ndash; Breadcrumb Menu&ndash;&gt;
                              &lt;!&ndash;  <li id="pagination" class="breadcrumb-menu hidden-md-down">
                                    <button class="btn btn-default btn-sm" @click="fetchDeposit(pagination.prev_page_url)"
                                            :disabled="!pagination.prev_page_url">
                                        Previous
                                    </button> &nbsp;
                                    <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span> &nbsp;
                                    <button class="btn btn-default btn-sm" @click="fetchDeposit(pagination.next_page_url)"
                                            :disabled="!pagination.next_page_url">Next
                                    </button>
                                </li>&ndash;&gt;
                            </div>

                            <div class="container-fluid">
                                <div class="animated fadeIn">

                                    &lt;!&ndash; new deposit form &ndash;&gt;
                                    <div id="newDepositForm" class="col-lg-12 uk-animation-slide-top-medium" v-show="newDepositForm">
                                        <div class="card">
                                            <div class="card-header">
                                                <i class="fa fa-edit"></i>  Fill in the new deposit details
                                                <div class="card-actions">
                                                    <a class="pull-right" style="color:#FC0000;"  @click="newDepositForm = false" uk-close></a>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <form @submit.prevent="invest"  @keydown="clear($event.target.name)" >

                                                    <div class="input-group">
                                                        <span class="input-group-addon">Amount BTC</span>
                                                        <input type="text" class="form-control" id="btc"   name="btc" v-model="investmentDetails.btc">
                                                    </div><br/>

                                                    <input type="hidden" name="ipn_url" value="https://example.com/includes/gateway.php">
                                                    <input type="hidden" name="want_shipping" value="0">
                                                    <input type="hidden" name="cmd" value="_pay">
                                                    <input type="hidden" name="cstyle" value="grid1">
                                                    <input type="hidden" name="reset" value="1">
                                                    <input type="hidden" name="merchant" value="'.$settings['merchant_id'].'">
                                                    <input type="hidden" name="currency" value="USD">
                                                    <input type="hidden" name="amountf" v-model="investmentDetails.btc">
                                                    <input type="hidden" name="item_name" value="'.$name.'">
                                                    <input type="hidden" name="lang" value="en">
                                                    <button type="submit" class="btn btn-primary btn-block">PAY WITH COINPAYMENTS - PAYPAL & BTC</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    &lt;!&ndash; new category form &ndash;&gt;




                                    &lt;!&ndash; search input &ndash;&gt;
                                    <div class="card-block" v-show="!newDepositForm">
                                        <div id="searchForm" class="col-lg-12 uk-animation-slide-top-medium">
                                            <div class="card">
                                                <div class="card-header">
                                                    <input type="text" v-model="searchWord" class="form-control" placeholder="search deposits....">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    &lt;!&ndash; search input &ndash;&gt;

                                    &lt;!&ndash; ALL THE CATEGORIES&ndash;&gt;
                                    <div class="row">

                                        <div class="col-sm-6 col-md-4 uk-animation-slide-bottom-medium" v-for="transaction in deposit" v-show="!newDepositForm">
                                            <div class="card uk-card uk-card-default uk-card-hover">
                                                <div class="card-block">
                                                    <strong class="categoryName"> Amount:</strong> &nbsp;${{ transaction.amount }}
                                                    &lt;!&ndash;   <span class="badge badge-pill badge-danger float-right" title="This is the total number of sermons in this Category" uk-tooltip>{{ depo.returns }}</span>&ndash;&gt;
                                                    <hr>
                                                    <p> <strong class="categoryDescription">ROI:</strong> &nbsp;${{ transaction.returns }}</p>
                                                    <p> <strong class="categoryDescription">Status:</strong> &nbsp;{{ transaction.status }}</p>
                                                    <p> <strong class="categoryDescription">Status:</strong> &nbsp;{{ transaction.rate }}%</p>
                                                    <p> <strong class="categoryDescription">Deposit Date:</strong> &nbsp;{{ transaction.created_at | formatDate }}</p>
                                                </div>

                                                <div class="uk-container card-footer">
                                                    &lt;!&ndash;  <a v-if="transaction.status == 'PENDING' " uk-icon="icon: pencil; ratio: 1.2" href="#editDepositModal" uk-toggle @click.prevent="editDeposit (transaction)"><i class="fa fa-pencil"></i></a>
                                                      &nbsp; &nbsp;
                      &ndash;&gt;
                                                    <a v-if="transaction.status == 'PENDING' " style="color:#FC0000;" uk-icon="icon: close; ratio: 1.2" uk-toggle   :href="`/delete-deposit/${transaction.id}`" ><i class="fa fa-times"></i></a>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <br><br>

                                    &lt;!&ndash; bottom pagination &ndash;&gt;
                                    <div class="card-block uk-animation-slide-top-medium" v-show="!newDepositForm">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="paginationn float-right">
                                                    <button class="btn btn-default btn-sm" @click="fetchDeposit(pagination.prev_page_url)"
                                                            :disabled="!pagination.prev_page_url">
                                                        Previous
                                                    </button> &nbsp;
                                                    <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span> &nbsp;
                                                    <button class="btn btn-default btn-sm" @click="fetchDeposit(pagination.next_page_url)"
                                                            :disabled="!pagination.next_page_url">Next
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    &lt;!&ndash; pagination &ndash;&gt;


                                </div>
                            </div>

                        </div>
                    </div>&lt;!&ndash; panel &ndash;&gt;





                </div>&lt;!&ndash; contentpanel &ndash;&gt;
            </div>&lt;!&ndash; mainpanel &ndash;&gt;

       -->
        </section>
    </div>
</template>

<script>
    import leftNav from '../components/leftNav.vue'
    import Header from '../components/Header.vue'
    import {coinpayment} from '../utilities/settings'
    import {bitpay} from '../utilities/settings'
   /*import {depositCount} from '../utilities/settings'
    import {clientDeposit} from '../utilities/settings'
    import {getUser} from '../utilities/settings'
    import {COINMARKETCAP_API_URI} from "../utilities/settings"
    import {CRYPTOCOMPARE_API_URI} from "../utilities/settings"
    import {CRYPTOCOMPARE_URI} from "../utilities/settings"*/
   // import Vue2Filters from 'vue2-filters'
    // The amount of milliseconds (ms) after which we should update our currency
    // charts.
    let UPDATE_INTERVAL = 60 * 1000;
   // Vue.use(Vue2Filters);

    export default {

        data () {
            return {
                authUser: [],
                coinsBtc: [],
                coinDataBtc: {},
                coinetEth: [],
                coinData1Eth: {},
                deposit: [],     /*using the fetchCategories()*/
                // depositToBeUpdated: {},
                depositToBeDeleted: {},
                pagination: {},
                searchWord:"",       /*used by the global filter*/
                depositCount: "",
                submitted: false,
                submit: false,
                investmentDetails: {
                    currency: '',
                    amount: '',
                    // payment_type: ''
                },
                errors: {},
                newDepositForm: false,
                filterParams: false,

            };
        },
        components: {
            'left-nav' : leftNav,
            'header-up': Header
        },

        created() {
            this.fetchDeposit();
            this.fetchDepositCount();
            this.getCoinsBtc();
            this.getAuthUser();
        },

        methods: {

            getAuthUser(){
                this.$http.get().then(function (response) {
                    // console.log(this.settings)
                    this.authUser = response.body;
                })
            },

            fetchDepositCount () {
                this.$http.get().then((response) => {
                    this.depositCount = response.body;
                });
            },

            fetchDeposit(page_url) {

                page_url = page_url ||
                this.$http.get(page_url).then((response) => {
                    this.makePagination(response.data)
                    this.deposit = response.data.data;
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


            /*invest() {
                let transaction = this.investmentDetails;
                this.investmentDetails = { currency: '', amount: ''};
                this.$http.post(coinpayment , transaction)
                    .then(function (response) {
                        // this.submitted = true;
                       // this.deposit.unshift(transaction);
                        //this.depositCount++;
                        this.investmentDetails = "";
                       // window.location = `${Laravel.appUrl}/user/invoice`

                    })
                    .catch((err) => {
                        this.errors = err.body.errors;
                    })
            },*/
            invest: function() {
                let that = this
                $.ajax({
                    url: 'https://www.coinpayments.net',
                    method: 'POST'
                }).then(function (response) {
                    if (response.error) {
                        console.err("There was an error " + response.error);
                    } else {

                        console.log(response);
                        that.submitted = true
                    }
                }).catch(function (err) {
                    console.error(err);
                });

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
                }).catch(function (err) {
                    console.error(err);
                });

            },
            getCoins1Eth: function() {
                let self = this
                $.ajax({
                    url: 'https://api.coinmarketcap.com/v1/ticker/ethereum/',
                    method: 'GET'
                }).then(function (response) {
                    if (response.error) {
                        console.err("There was an error " + response.error);
                    } else {

                        console.log(response);
                        self.coinetEth = response
                    }
                }).catch(function (err) {
                    console.error(err);
                });

            },

            /**
             * Return a CSS color (either red or green) depending on whether or
             * not the value passed in is negative or positive.
             */
            getColor: (num) => {
                return num > 0 ? "color:green;" : "color:red;";
            },

            /* editDeposit (transaction) {
                 this.depositToBeUpdated = transaction;
             },

             updateDeposit() {

                 let transaction = this.depositToBeUpdated;
                 this.$http.post(`${Laravel.appUrl}/user/update-deposit`, transaction).then((response) => {
                     this.fetchDeposit();
                     this.submitted = true;
                 }).catch( err => {
                     this.errors = err.body.errors;
                 });

             },

 */

            /* deleteDeposit (transaction) {

                 let shouldDelete = confirm('Are you sure you want to delete this episode');
                 if (!shouldDelete) return
                 this.$http.get('http://localhost:8000/delete-deposit' + '/' + transaction.id).then((response) => {
                     //  vm.$delete(vm.deposit, vm.deposit.indexOf(transaction))
                     //  vm.depositCount--
                     alert('deleted')
                 });

             },*/
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

            any() {
                return Object.keys(this.errors).length > 0;
            },



        },
        mounted(){
            this.getCoins1Eth();
        }

    }
    setInterval(() => {
        this.getCoins();
    }, UPDATE_INTERVAL);

    setInterval(() => {
        this.getCoins1();
    }, UPDATE_INTERVAL);

</script>


<style>

    .categoryName {
        color: #263238;
    }

    .categoryDescription {
        color: #20A8D8;
    }

</style>
