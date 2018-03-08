/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vue.use(require('vue-chat-scroll'));
window.Vue.use(require('vue2-google-maps'), {
  load: {
    key: 'AIzaSyApOdZZRmEDb73KykBsvIOyIeVOQRl1vMQ',
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)
  }
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('message', require('./components/Message.vue'));
Vue.component('mapa', require('./components/Map.vue'));

const app = new Vue({
    el: '#app',
    data: {
      messages: [],
    },

    mounted(){

    },
    methods: {

    }

});

$(function() {
    $('.editor').trumbowyg({
      svgPath: '/img/icons.svg'
    });
});
