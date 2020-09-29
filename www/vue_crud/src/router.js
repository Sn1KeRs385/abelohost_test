import Vue from 'vue'
import Router from 'vue-router'

// Layouts
import MainLayout from './components/Layout/MainLayout'

//indexPage
const indexPage = () => import('./views/HelloWorld.vue')

import models from './models';

Vue.use(Router)
let CRUDRoutes = [];
Object.values(models).forEach(model => {
    CRUDRoutes.push({
            name: `Таблица ${model.name}`,
            path: `/crud/${model.url}/index`,
            component: () => import(`./views/models/${model.url}/Index.vue`)
        });
});

let router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            redirect: '/index',
            component: MainLayout,
            children: [
                {
                    path: '/index',
                    component: indexPage
                },
                ...CRUDRoutes,
            ]
        },
        {
            path: '*',
            redirect: '/'
        }
    ]
})

export default router;
