import { createApp } from 'vue';
import HeaderComponent from './components/HeaderComponent.vue';
import SideBar from './components/SideBar.vue';
import FooterComponent from './components/FooterComponent.vue';

const appHeader = createApp(HeaderComponent);
const appSideBar = createApp(SideBar);
const appFooter = createApp(FooterComponent);

appHeader.mount('#header'); // Mount the HeaderComponent
appSideBar.mount('#sidebar'); // Mount the SideBar
appFooter.mount('#footer'); // Mount the FooterComponent
