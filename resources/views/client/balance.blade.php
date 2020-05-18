@extends('layouts.client_app')
@section('client_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <style type="text/css">
        a{
            font-size: 16px;
            color: black;
        }
        .swal2-title{
            font-size: 16px !important;
        }
        .panel{
            margin-left: 0px;
        }
        .panel-title {
            display: inline !important;
            font-weight: bold !important;
        }
        .display-table {
            display: table !important;
        }
        .display-tr {
            display: table-row !important;
        }
        .display-td {
            display: table-cell !important ;
            vertical-align: middle !important;
            width: 100% !important;
        }
    </style>
    <div id="myBalance">
        <hr>
        <div class="row">
            <div class="col-md-5">
                <p style="font-size: 20px;">
                    Earning Balance: $@{{myBalance.earning_balance}}
                </p>
            </div>
            <div class="col-md-5">
                <p style="font-size: 20px;">
                    Deposit Balance: $@{{myBalance.deposit_balance}}
                </p>
            </div>
        </div>
        <hr>
        <div class="row" >
            <div class="col-md-1">&nbsp;</div>
            <div class="col-md-8">
                <div class="row" >
                    <div class="panel panel-default credit-card-box" style="width: 100%;">
                        <div class="panel-heading display-table" >
                            <div class="row display-tr" >
                                <h3 class="panel-title display-td" >Payment Details</h3>
                                <div class="display-td" >
                                    <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">

                            @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif

                            <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                                  data-cc-on-file="false"
                                  data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                  id="payment-form">
                                @csrf

                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>Name on Card</label> <input
                                                class='form-control name-on-card' size='4' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group card required'>
                                        <label class='control-label'>Card Number</label> <input
                                                autocomplete='off' class='form-control card-number' size='20'
                                                type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                                        <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                                        class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                                                        type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Month</label> <input
                                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                                type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Year</label> <input
                                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label '>Amount</label> <input
                                                class='form-control card-amount' size='4' type='number' min="0">
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group hide'>
                                        <div class='alert-danger alert'>Please correct the errors and try
                                            again.</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        new Vue({
            el: '#myBalance',
            mounted() {
                var self = this;
                axios.get('/myBalance')
                    // .then(response => (this.myBalance = response.data))
                    .then(function (response) {
                        self.myBalance = response.data.wallet;
                        if(response.data.user_type == 2){
                            self.earningBalance = true;
                        }
                    })
            },
            created(){
                self = this;
                $(function() {
                    var $form         = $(".require-validation");
                    $('form.require-validation').bind('submit', function(e) {
                        var $form         = $(".require-validation"),
                            inputSelector = ['input[type=email]', 'input[type=password]',
                                'input[type=text]', 'input[type=file]','input[type=number]',
                                'textarea'].join(', '),
                            $inputs       = $form.find('.required').find(inputSelector),
                            $errorMessage = $form.find('div.error'),
                            valid         = true;
                        $errorMessage.addClass('hide');

                        $('.has-error').removeClass('has-error');
                        $inputs.each(function(i, el) {
                            var $input = $(el);
                            if ($input.val() === '') {
                                $input.parent().addClass('has-error');
                                $errorMessage.removeClass('hide');
                                e.preventDefault();
                            }
                        });

                        if (!$form.data('cc-on-file')) {
                            e.preventDefault();
                            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                            Stripe.createToken({

                                number: $('.card-number').val(),
                                cvc: $('.card-cvc').val(),
                                exp_month: $('.card-expiry-month').val(),
                                exp_year: $('.card-expiry-year').val(),
                            }, stripeResponseHandler);
                        }

                    });

                    function stripeResponseHandler(status, response) {
                        if (response.error) {
                            $('.error')
                                .removeClass('hide')
                                .find('.alert')
                                .text(response.error.message);
                        } else {
                            // token contains id, last4, and card type
                            var token = response['id'];
                            // insert the token into the form so it gets submitted to the server
                            $form.find('input[type=text]').empty();
                            var  amount= $('.card-amount').val();

                            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                            $form.append("<input type='hidden' name='stripeAmount' value='" + amount + "'/>");

                            // $form.get(0).submit();
                            axios.post('/depositWallet',{
                                stripeToken :token,
                                stripeAmount:amount
                            })
                                .then(function (response) {
                                    self.balanceDetails = true;
                                    self.balanceLoad = false;
                                    self.myBalance = response.data.wallet;
                                    if(response.data.user_type == 2){
                                        self.earningBalance = true;
                                    }

                                    $('.name-on-card').val('');
                                    $('.card-number').val('');
                                    $('.card-amount').val('');
                                    $('.card-cvc').val('');
                                    $('.card-expiry-month').val('');
                                    $('.card-expiry-year').val('');

                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'bottom-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        onOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer)
                                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                                        }
                                    })
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Your operation successfully done, please check balance'
                                    })


                                })
                        }
                    }
                });

            },
            data: {
                myBalance: [],
                earningBalance:false,
            },
        })


    </script>
@endsection
