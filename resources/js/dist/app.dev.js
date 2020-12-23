"use strict";

require("@fortawesome/fontawesome-free/js/all");

require("./bootstrap");

window.Vue = require("vue");
Vue.component("example-component", require("./components/ExampleComponent.vue")["default"]);
var app = new Vue({
  el: "#app",
  data: {//
  },
  methods: {
    imgGallery: function imgGallery(event) {
      $(".product_images_thumb").removeClass("selected");
      var id = event.target.src;
      $("#currentImg").attr("src", id);
      $(event.target).parent("div").addClass("selected");
    }
  }
});