import { CoreMenu } from '@core/types';

//? DOC: http://localhost:7777/demo/vuexy-angular-admin-dashboard-template/documentation/guide/development/navigation-menus.html#interface

export const menuIsp: CoreMenu[] = [
    // Dashboard
    {
        id: 'service',
        title: 'Servicios',
        translate: 'MENU.DASHBOARD',
        type: 'item',
        icon: 'home',
        url: 'isp/dashboard'
    },
];
