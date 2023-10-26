import { createApp } from 'vue';
import NavbarComponent from './components/NavbarComponent.vue';
import SidebarComponent from './components/SidebarComponent.vue';
import FooterComponent from './components/FooterComponent.vue';

const app = createApp({});

const appSideBar = createApp(SideBar);
const appFooter = createApp(FooterComponent);

appHeader.mount('#header'); // Mount the HeaderComponent
appSideBar.mount('#sidebar'); // Mount the SideBar
appFooter.mount('#footer'); // Mount the FooterComponent

app
    .component('NavbarComponent', NavbarComponent)
    .component('SidebarComponent', SidebarComponent)
    .component('FooterComponent', FooterComponent);

app.mount('#app');
