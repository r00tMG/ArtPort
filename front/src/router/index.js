import { createRouter, createWebHistory } from 'vue-router'
import Home from "../views/inviter/Home.vue";
import ArtisteShow from "../views/inviter/ArtisteShow.vue";
import ArtisteIndex from "../views/artiste/ArtisteIndex.vue";
import ArtisteCreate from "../views/artiste/ArtisteCreate.vue";
import ArtisteEdit from "@/views/artiste/ArtisteEdit.vue";
import Login from "@/views/auth/Login.vue";
import Register from "@/views/auth/Register.vue";


const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/artistes',
      name: 'artistes.index',
      component: ArtisteIndex,
      meta:{requiresAuth : true}
    },
    {
      path: '/show/:id',
      name: 'artistes.show',
      component: ArtisteShow,
    },
    {
      path: '/artistes/create',
      name: 'artistes.create',
      component: ArtisteCreate,
      meta:{requiresAuth : true}
    },
    {
      path: '/artistes/:id/edit',
      name: 'artistes.edit',
      component: ArtisteEdit,
      meta:{requiresAuth : true}
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    }

  ]
})

router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  const token = localStorage.getItem('token');

  if (requiresAuth && !token) {
    next('/');
  } else {
    next();
  }
})

export default router
