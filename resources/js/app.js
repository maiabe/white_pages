//import './bootstrap.js';
import { createApp } from 'vue';
import NavbarComponent from './components/NavbarComponent.vue';
import SidebarComponent from './components/SidebarComponent.vue';
import FooterComponent from './components/FooterComponent.vue';
//-- Import Font Awesome
import { fas } from '@fortawesome/free-solid-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(fas);

const app = createApp({});

app
    .component('NavbarComponent', NavbarComponent)
    .component('SidebarComponent', SidebarComponent)
    .component('FooterComponent', FooterComponent)
    .component('font-awesome-icon', FontAwesomeIcon);

app.mount('#app');
