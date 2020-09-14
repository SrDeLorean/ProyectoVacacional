import store from '@/store'

export const PublicRoutes = [
  {
    path: '/welcome',
    redirect: 'welcome',
    component: () => import('@/views/Pages/AuthLayout.vue'),
    beforeEnter: (to, from, next) => {
      if (store.getters['auth/authenticated']!=null) {
        if(store.getters['auth/user'].role=="admin"){
          return next({
              name: 'admin-dashboard'
          })
        }
        if(store.getters['auth/user'].role=="hotel"){
            return next({
                name: 'hotel-dashboard'
            })
        }
        if(store.getters['auth/user'].role=="tour"){
          return next({
              name: 'tour-dashboard'
          })
        }
        if(store.getters['auth/user'].role=="user"){
          return next({
              name: 'user-dashboard'
          })
        }
      }
      next()
    },
    children: [
      {
        path: 'home',
        name: 'home',
        component: () => import('@/views/Home.vue')
      },
      {
        path: 'login',
        name: 'login',
        component: () => import('@/views/Pages/Login.vue')
      },
      {
        path: 'register',
        name: 'register',
        component: () => import('@/views/Pages/Register.vue')
      },
      { 
        path: '*', 
        name: '404',
        component: () => import('@/views/NotFoundPage.vue') 
      }
    ]
  }
];