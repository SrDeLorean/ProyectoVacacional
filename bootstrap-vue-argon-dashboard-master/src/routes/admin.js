import store from '@/store'

export const AdminRoutes = [
    {
        path: '/admin',
        redirect: 'admin-dashboard',
        component: () => import('@/views/Layout/DashboardLayoutAdmin.vue'),
        beforeEnter: (to, from, next) => {
            if (!store.getters['auth/authenticated']) {
                return next({
                    name: 'login'
                })
            }
            if(store.getters['auth/user'].role!="admin"){
                
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
                path: 'dashboard',
                name: 'admin-dashboard',
                component: () => import('@/views/Dashboard.vue')
            },
            {
                path: 'user',
                name: 'admin-user',
                component: () => import( '@/views/admin/User.vue')
            }
        ]
    }
];