/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('select2');

const app = new Vue({
    el: '#app',
});

jQuery(document).ready(function ($) {
    $('.js-select2').select2({
        placeholder: {
            id: '',
            text: 'Choose'
        },
        allowClear: true
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('change', 'select[name="personal_information[project_sites][]"]', function () {

        var projectsite_id = $(this).val();

        $.ajax({
            type: 'GET',
            url: '/project-sites/' + projectsite_id  + '/area-managers',
            success: function (data) {
                $('select[name="personal_information[area_managers][]"]').html('<option selected="selected" value="">Choose...</option>');
                if (data) {
                    for (var i = 0; i < data.area_managers.length; i++) {
                        $('select[name="personal_information[area_managers][]"]').append('<option value="' + data.area_managers[i].id + '">' + data.area_managers[i].name + '</option>')
                    }
                }
            }
        });

    });

    $(document).on('click', '#sidebar-menu a', function (e) {
        e.preventDefault();

        var hash = $(this).attr('href');
        var title = $(this).data('title');
        var mainContainer = $("#information-form-container");

        $('#sidebar-menu a').removeClass('active');

        if (hash) {

            window.location.hash = hash;

            var newHash = hash.substr(1);
            var container = $('#' + newHash + '-container');

            mainContainer.find($('.card-header')).text(title);
            mainContainer.find($('.form-row')).hide();
            container.show();

            $(this).addClass('active');

            initializeClientFormButton();

        }

    });

    initializeClientFormButton();
    function initializeClientFormButton() {
        if ($('#sidebar-menu a.active').is(':first-child')) {
            $("#information-form-container #previous-form-btn").hide();
            $("#information-form-container #next-form-btn").show();
            $("#information-form-container #submit-form-btn").hide();
        } else if ($('#sidebar-menu a.active').not(':first-child') && ! $('#sidebar-menu a.active').is(':last-child')) {
            $("#information-form-container #previous-form-btn").show();
            $("#information-form-container #next-form-btn").show();
            $("#information-form-container #submit-form-btn").hide();
        } else if ($('#sidebar-menu a.active').is(':last-child')) {
            $("#information-form-container #previous-form-btn").show();
            $("#information-form-container #next-form-btn").hide();
            $("#information-form-container #submit-form-btn").show();
        }

    }

    $(document).on('click', '#next-form-btn', function (e) {
        e.preventDefault();

        $('#sidebar-menu a.active').next().trigger('click');
    });

    $(document).on('click', '#previous-form-btn', function (e) {
        e.preventDefault();

        $('#sidebar-menu a.active').prev().trigger('click');
    });

});