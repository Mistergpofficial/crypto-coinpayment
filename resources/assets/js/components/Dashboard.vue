<template>
    <div>

        <header-up></header-up>

        <section>

            <left-nav></left-nav>
            <div class="mainpanel">

                <!--<div class="pageheader">
                  <h2><i class="fa fa-home"></i> Dashboard</h2>
                </div>-->

                <div class="contentpanel">

                    <div class="row">
                        <div class="col-md-9 col-lg-8 dash-left">
                            <div class="panel panel-announcement">
                                <ul class="panel-options">
                                    <li><a><i class="fa fa-refresh"></i></a></li>
                                    <li><a class="panel-remove"><i class="fa fa-remove"></i></a></li>
                                </ul>
                                <div class="panel-heading">
                                    <h4 class="panel-title">Welcome, {{ authUser.full_name }}</h4>
                                </div>
                               <!-- <div class="panel-body">
                                    <label>Your Referral Invite URL</label>
                                    <input type="text" v-model="link.address" class="form-control" placeholder="Your Invite URL" name="inviteurl" >

                                </div>-->
                            </div><!-- panel -->

                            <div class="panel panel-site-traffic">
                                <div class="panel-heading">
                                    <ul class="panel-options">
                                        <li><a><i class="fa fa-refresh"></i></a></li>
                                    </ul>
                                 <!--   <h4 class="panel-title text-success">How Engaged Our Users Daily</h4>
                                    <p class="nomargin">Past 30 Days — Last Updated July 14, 2015</p>
                             -->   </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-4">
                                            <div class="pull-left">
                                                <div class="icon icon ion-stats-bars"></div>
                                            </div>
                                            <span class="info-box-number" v-if='contracts == ""'>CONTRACT <h3>$0</h3></span>
                                            <div v-for="contract in contracts">
                                                <h4 class="panel-title">CONTRACT</h4>
                                                <h3 v-if='contract.status == "ACTIVATED"'>${{ contract.amount_btc  }}</h3>
                                                <h5 v-if='contract.withdrawn === "YES"'><img :src="`https://cryptotraderslab.com/public/images/download.png`" width="25px"></h5>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-4">
                                            <div class="pull-left">
                                                <div class="icon icon ion-stats-bars"></div>
                                            </div>
                                            <span class="info-box-number" v-if='contracts == ""'>PROFIT <h3>$0</h3></span>
                                            <div v-for="contract in contracts">
                                                <h4 class="panel-title">PROFITS</h4>
                                                <h3 v-if='contract.status == "ACTIVATED"'>${{contract.returns | round }}</h3>
                                                <h5 v-if='contract.withdrawn === "YES"'><img :src="`https://cryptotraderslab.com/public/images/download.png`" width="25px"></h5>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-4">
                                            <div class="pull-left">
                                                <div class="icon icon ion-stats-bars"></div>
                                            </div>
                                            <span class="info-box-number" v-if='referralSum == ""'>REFERRALS <h3>$0</h3></span>
                                            <div v-for="ref in referralSum">
                                                <h4 class="panel-title">REFERRALS</h4>
                                                <h3 class="info-box-number" v-if='ref.amount != 0'>${{ ref.amount }}</h3>
                                                <h3 class="info-box-number" v-if='ref.amount == 0'>$0</h3>
                                            </div>
                                        </div>
                                    </div><!-- row -->

                                    <div class="mb20"></div>
                                </div><!-- panel-body -->


                                <div class="panel-body">
                                    <label>Your Referral Invite URL</label>
                                    <input type="text" v-model="link.address" class="form-control" placeholder="Your Invite URL" name="inviteurl" >

                                </div>




                                <div class="table-responsive">
                                    <table class="table table-bordered table-default table-striped nomargin">
                                        <thead class="success">
                                        <tr>
                                            <th class="text-right">Cryptocurrency</th>
                                            <th class="text-right">Symbol</th>
                                            <th class="text-right">Price($)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                           <td></td>
                                           <td class="text-right"></td>
                                           <td class="text-right"></td>
                                           <td class="text-right"></td>
                                       </tr>
                                        <tr v-for="coin in coiniiBtcEth">
                                            <td>{{ coin.name }}</td>
                                            <td class="text-right">{{ coin.symbol }}</td>
                                            <td class="text-right">{{ coin.price_usd }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><!-- table-responsive -->




                            </div><!-- panel -->

                        </div><!-- col-md-9 -->



                        <div class="col-md-3 col-lg-4 dash-right">
                            <div class="row">
                                <div class="col-sm-5 col-md-12 col-lg-6">
                                    <div class="panel panel-danger panel-weather">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">REFERRALS</h4>
                                        </div>
                                        <div class="panel-body inverse">
                                            <div class="row mb10">
                                                <div class="col-xs-6">
                                                    <h2 class="today-day">You currently have {{ referralsCount }} people under you</h2>
                                                   <!-- <h3 class="today-date">July 13, 2015</h3>-->
                                                </div>
                                                <div class="col-xs-6">
                                                <!--    <i class="wi wi-hail today-cloud"></i>-->
                                                </div>
                                            </div>
                                            <p class="nomargin"></p>
                                            <div class="row mt10">
                                                <div class="col-xs-7">

                                                </div>
                                                <div class="col-xs-5">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- col-md-12 -->
                                <div class="col-sm-5 col-md-12 col-lg-6">
                                    <div class="panel panel-primary list-announcement">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"> Announcements</h4>
                                        </div>
                                        <div class="panel-body">
                                            <ul class="list-unstyled mb20" v-for="announcement in announcements">
                                                <li>
                                                    <a href="">{{ announcement.content }}...</a>
                                                    <small>{{ announcement.created_at | formatDate}} <a href="#">Admin</a></small>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="panel-footer">
                                            <button class="btn btn-primary btn-block" @click="getAnnouncements(pagination.prev_page_url)"
                                                    :disabled="!pagination.prev_page_url"><i class="fa fa-arrow-left"></i>Previous</button>
                                            <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
                                            <button class="btn btn-primary btn-block" @click="getAnnouncements(pagination.next_page_url)"
                                                    :disabled="!pagination.next_page_url">Next<i class="fa fa-arrow-right"></i></button>

                                        </div>
                                    </div>
                                </div><!-- col-md-12 -->
                            </div><!-- row -->

                        </div><!-- col-md-3 -->
                    </div><!-- row -->

                </div><!-- contentpanel -->

            </div><!-- mainpanel -->

        </section>
    </div>
</template>

<script>
    import leftNav from '../components/leftNav.vue'
    import Header from '../components/Header.vue'
    import {getLink} from '../utilities/settings'
    import {getUser} from '../utilities/settings'
    import {myReferralsCount} from '../utilities/settings'
    import {getAnnouncement} from '../utilities/settings'
    import {getContract} from '../utilities/settings'
    import {getReferralSum} from '../utilities/settings'
    let UPDATE_INTERVAL = 60 * 1000;
    export default {
        data() {
            return {
                link: {},
                authUser: [],
                referralsCount: [],
                announcements: {},
                contracts: {},
                pagination: {},
               // coiniiBtcEth: [],
                referralSum: {}
              //  coinsBtc: {}
            }
        },
        components: {
            'left-nav' : leftNav,
            'header-up': Header
        },
        created() {
            this.getLink();
            this.getUser();
            this.getContracts();
            this.getReferralSum();
            this.myReferralsCount();
            this.getAnnouncements();
            this.getCoins3BtcEth();
        },
        /*computed: {
            result: function () {
                return this.link[0].address;
            }
        },*/
        methods: {
            getLink(){
                this.$http.get(getLink).then(function (response) {
                    this.link = response.body;
                })
                    .catch( (err) => {
                        console.log(err)
                    })
            },
            getContracts() {
                this.$http.get(getContract).then(function (response) {
                    this.contracts = response.body;
                })
                    .catch( (err) => {
                        console.log(err)
                    });
            },
            getReferralSum() {
                this.$http.get(getReferralSum).then(function (response) {
                    this.referralSum = response.body;
                })
                    .catch( (err) => {
                        console.log(err)
                    });
            },
            getUser() {
                this.$http.get(getUser).then(function (response) {
                    this.authUser = response.body;
                })
                    .catch( (err) => {
                        console.log(err)
                    });
            },
            myReferralsCount() {
                this.$http.get(myReferralsCount).then(function (response) {
                    this.referralsCount = response.body;
                })
                    .catch( (err) => {
                        console.log(err)
                    });
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
            /*getCoinsBtc: function() {
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

            },*/
            getCoins3BtcEth: function() {
                let that = this
                $.ajax({
                    url: 'https://api.coinmarketcap.com/v1/ticker/?limit=10',
                    method: 'GET'
                }).then(function (response) {
                    if (response.error) {
                        console.err("There was an error " + response.error);
                    } else {

                        console.log(response);
                        that.coiniiBtcEth = response
                    }
                }).catch(function (err) {
                    console.error(err);
                });

            }
        }
    }
    setInterval(() => {
        this.getCoins3BtcEth();
    }, UPDATE_INTERVAL);

</script>

<style type="text/css">
    .vertical-menu {
        width: 200px;
    }
</style>