import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import ListAddress from '@/components/ListAddress'
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/ola',
      name: 'HelloWorld',
      component: HelloWorld
    },

      {
        path: '/',
        name: 'ListAddress',
        component: ListAddress
      }
  ]
})
