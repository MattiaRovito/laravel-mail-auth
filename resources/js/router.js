import Vue from 'vue';
import VueRouter from 'vue-router';

// Questo consente di utilizzarlo come plug-in
Vue.use(VueRouter);

// Qui importiamo i component

import Home from './pages/Home';
import About from './pages/About';
import Contact from './pages/Contact';
import Post from './pages/Post';
import SinglePost from './pages/SinglePost';


const router = new VueRouter({
    // si specifica la modalità di visualizzazione

    mode : 'history',

    // e si costruiscono le rotte

    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
            // questo component verrà creato dentro una cartella in resources/js, chiamata pages, la quale rappresenterà le nostre pagine
        },
        {
            path: '/chi-siamo',
            name: 'about',
            component: About
        },
        {
            path: '/contatti',
            name: 'contact',
            component: Contact
        },
        {
            path: '/posts',
            name: 'post',
            component: Post
        },
        {
            path: '/post/:slug',
            name: 'post-detail',
            component: SinglePost
        }
    ]
});





export default router;