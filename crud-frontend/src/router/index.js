import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
//import layout from '@/components/Layout'
import Input from '@/components/Input'
import Card from '@/components/Card'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'card',
      component: Card
    },
    {
      path: '/input',
      name: 'hello-world',
      component: HelloWorld
    }
  ]
})
