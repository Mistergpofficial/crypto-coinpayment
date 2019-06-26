<template>
    <div>
        <header-up></header-up>
        <section>
            <left-nav></left-nav>

            <div class="mainpanel">

                <div class="contentpanel">

                    <ol class="breadcrumb breadcrumb-quirk">
                        <li><a :href="`https://cryptotraderslab.com`"><i class="fa fa-home mr5"></i> Home</a></li>
                        <li><a :href="`https://cryptotraderslab.com/user/transactions`">Transactions</a></li>
                    </ol>

                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">MY TRANSACTIONS</h4>
                            <p>Total Transactions:  &nbsp; {{ transactions.length }} </p>
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
                                        <th>Amount($)</th>
                                        <th>Rate(%)</th>
                                        <th>Full Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Address</th>
                                      <!--  <th class="text-right">State</th>
                                        <th class="text-right">City</th>-->
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="trans in transactions">
                                        <td class="text-center">
                                            <label class="ckbox ckbox-primary">
                                                <input type="checkbox"><span></span>
                                            </label>
                                        </td>
                                        <td>{{ trans.amount_btc }}</td>
                                        <td>{{ trans.rate | round }}</td>
                                        <td>{{ trans.buyer_name }}</td>
                                        <td class="text-center">{{ trans.buyer_email }}</td>
                                        <td class="text-center">{{ trans.address }}</td>
                                        <!--<td class="text-right">{{ ref.state }}</td>
                                        <td class="text-right">{{ ref.city }}</td>-->
                                        <td>
                                            <ul class="table-options">
                                                <li><a href=""><i class="fa fa-pencil"></i></a></li>
                                                <li><a href=""><i class="fa fa-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <span v-if="transactions && transactions.length === 0">
                                    <center class="text-center">No transaction Yet.</center>
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
                                    <button class="btn btn-default btn-sm" @click="myTransaction(pagination.prev_page_url)"
                                            :disabled="!pagination.prev_page_url">
                                        Previous
                                    </button> &nbsp;
                                    <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span> &nbsp;
                                    <button class="btn btn-default btn-sm" @click="myTransaction(pagination.next_page_url)"
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
    import {getTransactions} from '../utilities/settings'
    export default {
        data() {
            return {
                authUser: {},
               transactions: {},
                pagination: {}
            }
        },
        components: {
            'left-nav' : leftNav,
            'header-up': Header
        },
        created() {
            this.getUser();
            this.myTransaction();
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
            myTransaction(page_url) {

                page_url = page_url || getTransactions
                this.$http.get(page_url).then((response) => {
                    this.makePagination(response.data)
                    this.transactions = response.data.data;
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
            }
        }
    }
</script>