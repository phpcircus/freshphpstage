import Vue from 'vue';
import store from 'JS/store';
import Dates from 'Mixins/Dates';
import VueStash from 'vue-stash';
import Inertia from 'inertia-vue';
import VModal from 'vue-js-modal';
import PortalVue from 'portal-vue';
import ParsesUrls from 'Mixins/ParsesUrls';
import Dispatchable from 'Mixins/Dispatchable';
import VueInstantSearch from 'vue-instantsearch';
import Snotify, { SnotifyPosition } from 'vue-snotify';

// Use mixins
Vue.mixin({ methods: { route: (...args) => window.route(...args).url() } });
Vue.mixin(Dispatchable);
Vue.mixin(ParsesUrls);
Vue.mixin(Dates);

// Use Vue instant-search
Vue.use(VueInstantSearch);

// Use PortalVue
Vue.use(PortalVue);

// Use Vue-Stash for state management
Vue.use(VueStash);

// Use Vue-Modal
Vue.use(VModal, { componentName: 'modal-component' });

// Use Snotify for notifications
Vue.use(Snotify, {
    toast: {
        position: SnotifyPosition.rightTop,
        timeout: 3000,
        showProgressBar: true,
        closeOnClick: false,
        pauseOnHover: true,
    }
});

// Use Inertia
Vue.use(Inertia);

// Filters
Vue.filter('ucase', function (value) {
    return value ? value.toUpperCase() : '';
});

if (process.env.MIX_APP_ENV === 'production') {
    Vue.config.devtools = false;
    Vue.config.debug = false;
    Vue.config.silent = true;
    Vue.config.productionTip = false;
}

let app = document.getElementById('app');

const pages = {
    'Posts/Create': require('../../Pages/Posts/Create').default,
  }

new Vue({
    data: { store },
    render: h => h(Inertia, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            // resolveComponent: page => files(`./Pages/${page}.vue`).default,
            resolveComponent: name => {
                return name !== 'Posts/Create' ? import (`@/Pages/${name}`).then(module => module.default) : pages[name];
            },
        },
    }),
}).$mount(app)
