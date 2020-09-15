import store from '@/store'

export const TourRoutes = [
    {
        path: '/tour',
        redirect: 'tour-dashboard',
        component: () => import('@/views/Layout/DashboardLayoutTour.vue'),
        beforeEnter: (to, from, next) => {
            if (!store.getters['auth/authenticated']) {
                return next({
                    name: 'login'
                })
            }
            if(store.getters['auth/user'].role!="tour"){
                
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
                name: 'tour-dashboard',
                component: () => import('@/views/tour/Dashboard.vue')
            }
        ]
    }
];