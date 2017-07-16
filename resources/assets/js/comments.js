require('./vue-bootstrap');

Vue.component('comments', require('./components/Comments.vue'));

const app = new Vue({
    el: '#comments'
});
