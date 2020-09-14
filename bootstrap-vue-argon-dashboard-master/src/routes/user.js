import store from '@/store'

export const UserRoutes = [
    {
        path: '/user',
        redirect: 'user-dashboard',
        component: () => import('@/views/Layout/DashboardLayoutAdmin.vue'),
        beforeEnter: (to, from, next) => {
            if (!store.getters['auth/authenticated']) {
                return next({
                    name: 'login'
                })
            }
            if(store.getters['auth/user'].role!="user"){
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
            }
            next()
        },
        children: [
            {
                path: 'dashboard',
                name: 'user-dashboard',
                component: () => import('@/views/Dashboard.vue')
            }
        ]
    }
];