import store from '@/store'

export const HotelRoutes = [
    {
        path: '/hotel',
        redirect: 'hotel-dashboard',
        component: () => import('@/views/Layout/DashboardLayoutHotel.vue'),
        beforeEnter: (to, from, next) => {
            if (!store.getters['auth/authenticated']) {
                return next({
                    name: 'login'
                })
            }
            if(store.getters['auth/user'].role!="hotel"){
                
                if(store.getters['auth/user'].role=="admin"){
                    return next({
                        name: 'admin-dashboard'
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
                name: 'hotel-dashboard',
                component: () => import('@/views/hotel/Dashboard.vue')
            },
            {
                path: 'property',
                name: 'hotel-property',
                component: () => import('@/views/hotel/Property.vue')
            }
        ]
    }
];