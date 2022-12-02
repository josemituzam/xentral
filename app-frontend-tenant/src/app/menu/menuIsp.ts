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
        translate: 'MENU.ISP.SECTION',
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
                        id: 'customer',
                        title: 'Customer',
                        translate: 'MENU.ISP.COMMERCIAL.CUSTOMER',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/customer/list'
                    },
                    {
                        id: 'contract',
                        title: 'Contract',
                        translate: 'MENU.ISP.COMMERCIAL.CONTRACTS',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/contract/list'
                    },
                    {
                        id: 'plan',
                        title: 'Plan',
                        translate: 'MENU.ISP.COMMERCIAL.PLANS',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/plan/list'
                    },
                    {
                        id: 'sector',
                        title: 'Sector',
                        translate: 'MENU.ISP.COMMERCIAL.SECTIONS',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/sector/list'
                    }
                ]
            },
            {
                id: 'technicalarea',
                title: 'Technical Area',
                translate: 'MENU.ISP.TECHNICALAREA.COLLAPSIBLE',
                type: 'collapsible',
                icon: 'cpu',
                children: [
                    {
                        id: 'connection',
                        title: 'Connection',
                        translate: 'MENU.ISP.TECHNICALAREA.CONNECTION',
                        type: 'item',
                        icon: 'circle',
                        url: '#'
                    },
                    {
                        id: 'red',
                        title: 'Red',
                        translate: 'MENU.ISP.TECHNICALAREA.RED',
                        type: 'item',
                        icon: 'circle',
                        url: '#'
                    },
                ]
            },



            {
                id: 'tableofservice',
                title: 'Table of Service',
                translate: 'MENU.ISP.TABLEOFSERVICE.COLLAPSIBLE',
                type: 'collapsible',
                icon: 'slack',
                children: [
                    {
                        id: 'newticket',
                        title: 'NewTicker',
                        translate: 'MENU.ISP.TABLEOFSERVICE.NEWTICKET',
                        type: 'item',
                        icon: 'circle',
                        url: '#'
                    },
                    {
                        id: 'meticket',
                        title: 'MeTicket',
                        translate: 'MENU.ISP.TABLEOFSERVICE.METICKET',
                        type: 'item',
                        icon: 'circle',
                        url: '#'
                    },
                ]
            },





        ]
    },




    /* {
         id: 'invoice',
         title: 'Facturación',
         translate: 'MENU.INVOICE',
         type: 'item',
         icon: 'clipboard',
         url: '#'
     },*/
];
