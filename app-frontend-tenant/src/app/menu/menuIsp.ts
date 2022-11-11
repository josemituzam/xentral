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

    {
        id: 'apps',
        type: 'section',
        title: 'Apps & Pages',
        translate: 'MENU.APPS.SECTION',
        icon: 'package',
        children: [
            {
                id: 'commercial',
                title: 'Commercial',
                translate: 'MENU.ISP.COMMERCIAL.COLLAPSIBLE',
                type: 'collapsible',
                icon: 'briefcase',
                children: [
                    {
                        id: 'edit',
                        title: 'Edit',
                        translate: 'MENU.ISP.COMMERCIAL.CUSTOMER',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/customer/list'
                    },
                    {
                        id: 'branch',
                        title: 'Branch',
                        translate: 'MENU.ISP.COMMERCIAL.CONTRACTS',
                        type: 'item',
                        icon: 'circle',
                        url: 'manager/branch/list'
                    },
                    {
                        id: 'sales',
                        title: 'Sales',
                        translate: 'MENU.ISP.COMMERCIAL.PLANS',
                        type: 'item',
                        icon: 'circle',
                        url: 'manager/sales/list'
                    },
                    {
                        id: 'sectores',
                        title: 'Sector',
                        translate: 'MENU.ISP.COMMERCIAL.SECTORS',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/sector/list'
                    }
                ]
            },
        ]
    }
];
