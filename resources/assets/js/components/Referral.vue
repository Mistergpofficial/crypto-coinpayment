<template>
    <div>
        <header-up></header-up>
        <section>
            <left-nav></left-nav>

            <div class="mainpanel">

                <div class="contentpanel">

                    <ol class="breadcrumb breadcrumb-quirk">
                        <li><a :href="`https://cryptotraderslab.com`"><i class="fa fa-home mr5"></i> Home</a></li>
                        <li><a :href="`https://cryptotraderslab.com/user/referral`">Referrals</a></li>
                    </ol>

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">MY REFERRAL LIST</h4>
                            <p>Attention <span style="color:darkblue;">{{authUser.full_name}}</span>, here are the people who registered with your link.</p>
                            <p>Total Referral:  &nbsp; {{referralsCount}} </p>
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table nomargin">
                                    <thead>
                                    <tr>
                                        <th class="text-center">
                                            <label class="ckbox ckbox-primary">
                                                <input type="checkbox"><span></span>
                                            </label>
                                        </th>
                                        <th>FullName</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th class="text-center">Mobile</th>
                                        <th class="text-center">Country</th>
                                        <th class="text-right">State</th>
                                        <th class="text-right">City</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="ref in referrals">
                                        <td class="text-center">
                                            <label class="ckbox ckbox-primary">
                                                <input type="checkbox"><span></span>
                                            </label>
                                        </td>
                                        <td>{{ ref.full_name }}</td>
                                        <td>{{ ref.email }}</td>
                                        <td>{{ ref.username }}</td>
                                        <td class="text-center">{{ ref.phone }}</td>
                                        <td class="text-center">{{ ref.country }}</td>
                                        <td class="text-right">{{ ref.state }}</td>
                                        <td class="text-right">{{ ref.city }}</td>
                                        <td>
                                            <ul class="table-options">
                                                <li><a href=""><i class="fa fa-pencil"></i></a></li>
                                                <li><a href=""><i class="fa fa-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <span v-if="referrals && referrals.length === 0">
                                    <center class="text-center">No referral Yet.</center>
                                    </span>

                                    </tbody>
                                </table>
                            </div><!-- table-responsive -->
                        </div>
                    </div><!-- panel -->

                    <!-- bottom pagination -->
                    <div class="card-block uk-animation-slide-top-medium">
                        <div class="card">
                            <div class="card-header">
                                <div class="paginationn float-right">
                                    <button class="btn btn-default btn-sm" @click="myReferrals(pagination.prev_page_url)"
                                            :disabled="!pagination.prev_page_url">
                                        Previous
                                    </button> &nbsp;
                                    <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span> &nbsp;
                                    <button class="btn btn-default btn-sm" @click="myReferrals(pagination.next_page_url)"
                                            :disabled="!pagination.next_page_url">Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- pagination -->

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
                authUser: {},
                referrals: {},
                referralsCount: {},
                pagination: {}
            }
        },
        components: {
            'left-nav' : leftNav,
            'header-up': Header
        },
        created() {
            this.getUser();
            this.myReferrals();
            this.myReferralsCount();
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
            myReferralsCount() {
                this.$http.get(myReferralsCount).then(function (response) {
                    this.referralsCount = response.body;
                })
                    .catch( (err) => {
                        console.log(err)
                    });
            },
        }
    }
</script>