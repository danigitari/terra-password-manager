import "./bootstrap";
import { createApp } from "vue";
import app from "./components/App.vue";
import router from "./components/router/index";

// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { aliases, mdi } from 'vuetify/iconsets/mdi'



const vuetify = createVuetify({
    components,
    directives,

    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
          mdi,
        },
      },    
});
createApp(app).use(router).use(vuetify).mount("#app");
