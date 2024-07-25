import { createRouter, createWebHistory } from 'vue-router'
import Home from "../views/inviter/Home.vue";
import ArtisteShow from "../views/inviter/ArtisteShow.vue";
import ArtisteIndex from "../views/artiste/ArtisteIndex.vue";
import ArtisteCreate from "../views/artiste/ArtisteCreate.vue";


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
      component: ArtisteIndex
    },
    {
      path: '/artistes/:id',
      name: 'artistes.show',
      component: ArtisteShow
    },
    {
      path: '/create',
      name: 'artistes.create',
      component: ArtisteCreate
    },




  ]
})

export default router
