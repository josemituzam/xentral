import { CoreMenu } from '@core/types';

//? DOC: http://localhost:7777/demo/vuexy-angular-admin-dashboard-template/documentation/guide/development/navigation-menus.html#interface

export const menuIsp: CoreMenu[] = [
    // Dashboard
    {
        id: 'dashboard',
        title: 'Dashboard',
        translate: 'MENU.DASHBOARD',
        type: 'item',
        icon: 'home',
        url: 'isp/dashboard/soon'
    },

    {
        id: 'apps',
        type: 'section',
        title: 'Módulos',
        translate: 'MENU.MODULE.SECTION',
        icon: 'package',
        children: [
            {
                id: 'commercial',
                title: 'Comercial',
                translate: 'MENU.MODULE.COMMERCIAL.COLLAPSIBLE',
                type: 'collapsible',
                icon: 'briefcase',
                children: [
                    {
                        id: 'customer',
                        title: 'Clientes',
                        translate: 'MENU.MODULE.COMMERCIAL.CUSTOMER',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/customer/list'
                    },
                    {
                        id: 'contract',
                        title: 'Contratos',
                        translate: 'MENU.MODULE.COMMERCIAL.CONTRACTS',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/contract/list'
                    },
                    {
                        id: 'plan',
                        title: 'Planes',
                        translate: 'MENU.MODULE.COMMERCIAL.PLANS',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/plan/list'
                    },
                    {
                        id: 'sector',
                        title: 'Sectores',
                        translate: 'MENU.MODULE.COMMERCIAL.SECTIONS',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/sector/list'
                    }
                ]
            },
            {
                id: 'technicalarea',
                title: 'Área técnica',
                translate: 'MENU.MODULE.TECHNICALAREA.COLLAPSIBLE',
                type: 'collapsible',
                icon: 'cpu',
                children: [
                    {
                        id: 'connection',
                        title: 'Conexiones',
                        translate: 'MENU.MODULE.TECHNICALAREA.CONNECTION',
                        type: 'item',
                        icon: 'circle',
                        url: '#'
                    },
                    {
                        id: 'red',
                        title: 'Red',
                        translate: 'MENU.MODULE.TECHNICALAREA.RED',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/red/main'
                    },
                ]
            },



            {
                id: 'tableofservice',
                title: 'Mesa de servicios',
                translate: 'MENU.MODULE.TABLEOFSERVICE.COLLAPSIBLE',
                type: 'collapsible',
                icon: 'slack',
                children: [
                    {
                        id: 'newticket',
                        title: 'Nuevo ticket',
                        translate: 'MENU.MODULE.TABLEOFSERVICE.NEWTICKET',
                        type: 'item',
                        icon: 'circle',
                        url: '#'
                    },
                    {
                        id: 'opentickets',
                        title: 'Tickets abiertos',
                        translate: 'MENU.MODULE.TABLEOFSERVICE.OPENTICKET',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/helpdesk/open/list'
                    },
                    {
                        id: 'closetickets',
                        title: 'Tickets cerrados',
                        translate: 'MENU.MODULE.TABLEOFSERVICE.CLOSETICKET',
                        type: 'item',
                        icon: 'circle',
                        url: 'isp/helpdesk/close/list'
                    },
                ]
            },





        ]
    },


    {
        id: 'setting',
        type: 'section',
        title: 'Configuraciones',
        translate: 'MENU.SETTING.SECTION',
        icon: 'package',
        children: [
            {
                id: 'template',
                title: 'Plantillas',
                translate: 'MENU.SETTING.TEMPLATE',
                type: 'item',
                icon: 'clipboard',
                url: 'isp/template/main'
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
