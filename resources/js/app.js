import './bootstrap';
import { createApp } from 'vue';
import { plugin, defaultConfig } from '@formkit/vue'

import NavbarComponent from './components/NavbarComponent.vue';
import SidebarComponent from './components/SidebarComponent.vue';
import FooterComponent from './components/FooterComponent.vue';
import TableComponent from './components/TableComponent.vue';
import ModalComponent from './components/ModalComponent.vue';
import FormComponent from './components/FormComponent.vue';
import AddComponent from './components/ModalContent/AddComponent.vue';
import EditComponent from './components/ModalContent/EditComponent.vue';
import DeleteComponent from './components/ModalContent/DeleteComponent.vue';
import ApproveComponent from './components/ModalContent/ApproveComponent.vue';
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
    .component('TableComponent', TableComponent)
    .component('ModalComponent', ModalComponent)
    .component('FormComponent', FormComponent)
    .component('AddComponent', AddComponent)
    .component('EditComponent', EditComponent)
    .component('DeleteComponent', DeleteComponent)
    .component('ApproveComponent', ApproveComponent)
    .component('font-awesome-icon', FontAwesomeIcon);


app.use(plugin, defaultConfig).mount('#app');


//vue.component('edit-component', EditComponent);
