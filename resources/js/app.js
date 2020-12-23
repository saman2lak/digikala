require("./bootstrap");
import "@fortawesome/fontawesome-free/js/all";

window.Vue = require("vue");
Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
const app = new Vue({
    el: "#app",
    data: {
        //
    },
    methods: {
        imgGallery: function(event) {
            $(".product_images_thumb").removeClass("selected");
            var id = event.target.src;
            $("#currentImg").attr("src", id);
            $(event.target)
                .parent("div")
                .addClass("selected");
        }
    }
});
