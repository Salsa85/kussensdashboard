/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import $ from "jquery";

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = {
    marge: 1.4,
    data: {
        uid:        null,
        fabric:     null,
        filling:    null,
        finish:     null,
        length:     null,
        depth:      null,
        thickness:  null,
    },
    pillowNumber: 0,
    pillows: [],

    init () {

        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });

       $('body').on('click', '.calculate', $.proxy(this.getPrice, this));

        $('.paid').on('click', (e) => {
            let id = $(e.currentTarget).closest('.error').data('id');
            let paid = $('.paid').val();



            if ($(e.currentTarget).prop('checked')) {

              jQuery.ajax({
                   url: "https://handling.outofbeta.nl/update",
                   method: 'post',
                   data: {
                      id: id,
                      paid: $('.paid').val(),
                   },
                   success: function(result){
                      console.log(result);
                   }});

            } else {
                jQuery.ajax({
                     url: "https://handling.outofbeta.nl/remove-paid",
                     method: 'post',
                     data: {
                        id: id,
                        paid: 0,
                     },
                     success: function(result){
                        console.log(result);
                     }});
            }

        });

    return this;

},

    getData() {

        /**
         * Get input data
         * @type {Object}
         */
        app.data = {
            uid:        $('select[name=products]').val(),
            fabric:     $('select[name=fabrics]').val(),
            filling:    $('select[name=fillings]').val(),
            finish:     $('select[name=finishes]').val(),
            length:     $('input[name=length]').val(),
            depth:      $('input[name=depth]').val(),
            thickness:  $('input[name=thickness]').val(),
        }

    },

    getPrice(e) {
        e.preventDefault();

        this.getData();

        jQuery.ajax({
             url: "https://handling.outofbeta.nl/get-price",
             method: 'post',
             data: app.data,
             success: function(result){
                $('.fabric__price label span').html( parseFloat(result[0]).toFixed(2));
                $('.filling__price label span').html(parseFloat(result[1]).toFixed(2));
                $('.finish__price label span').html(parseFloat(result[2]).toFixed(2));

                $('.buy').html(app.getBuyPrice(result));
                $('.sell').html(app.getSellPrice(result));
                $('.btw').html( app.getTax(result));
                $('.incl').html(app.getConsumerPrice(result));

                result.push( $('.fabrics option:selected').text(), $('.fillings option:selected').text(), $('.finishes option:selected').text() );
                app.pillows.push(result);
                app.pillowNumber += 1;
                $('.pillows').empty('');

                console.log(app.pillows);

                for (var i = 0; i < app.pillowNumber; i++) {
                    $('.pillows').append(`
                        <div class="pillow">
                            <span class="pillow-key"> ${app.pillowNumber} </span>
                            <span class="pillow-key"> ${app.pillows[i][3]} </span>
                            <span class="pillow-key"> ${app.pillows[i][4]} </span>
                            <span class="pillow-key"> ${app.pillows[i][5]} </span>
                            <span class="pillow-key"> ${ app.getConsumerPrice(app.pillows[i])} </span>

                        </div>

                        `);
                }

             }});
    },

    getBuyPrice(result) {

        let price = parseFloat(result[0] + result[1] + result[2]).toFixed(2);

        return price;

    },

    getSellPrice(result) {

        let price = parseFloat((result[0] + result[1] + result[2]) * app.marge).toFixed(2);

        return price;

    },

    getTax(result) {

        let price = parseFloat((result[0] + result[1] + result[2]) / 100 * 21).toFixed(2);

        return price;
    },

    getConsumerPrice(result) {

        let price = parseFloat(((result[0] + result[1] + result[2]) * 1.4)  * 1.21 ).toFixed(2)

        return price;
    }
}

$(document).ready($.proxy(app.init, app));
