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

    init () {

        $('.paid').on('click', (e) => {
            let id = $(e.currentTarget).closest('.error').data('id');
            let paid = $('.paid').val();

            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });

            if ($(e.currentTarget).prop('checked')) {


                console.log(id);



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
    }
}



$(document).ready($.proxy(app.init, app));
let data = {
    items: [{

    }]

}
