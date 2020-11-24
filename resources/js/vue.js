// require("./vue.js");
window.Vue = require("vue");
Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component(
    "konfigurasi-pesanan-atk",
    require("./components/KonfPesananATK.vue").default
);
Vue.component(
    "konfigurasi-pesanan-file",
    require("./components/KonfPesananFile.vue").default
);
Vue.component("current-pesanan", {
    functional: true,
    props: ["data"],
    render: function(createElement, context) {
        // You have access to context.props.superProp here
        // console.log(this.$root.$data);
        // this.$root.$current_pesanan = context.data;
        return createElement("div", context.data, context.children);
    }
});

const app = new Vue({
    el: "#app",
    data: {
        current_pesanan: {}
    }
});