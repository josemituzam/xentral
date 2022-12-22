import { CoreMenu } from '@core/types';

//? DOC: http://localhost:7777/demo/vuexy-angular-admin-dashboard-template/documentation/guide/development/navigation-menus.html#interface

export const menu: CoreMenu[] = [
  // Dashboard
  {
    id: 'service',
    title: 'Servicios',
    translate: 'MENU.SERVICE',
    type: 'item',
    icon: 'home',
    url: 'manager/service'
  },
  // Apps & Pages
  {
    id: 'apps',
    type: 'section',
    title: 'Configuraciones',
    translate: 'MENU.APPS.SECTION',
    icon: 'package',
    children: [
      {
        id: 'companies',
        title: 'Empresa',
        translate: 'MENU.APPS.COMPANY.COLLAPSIBLE',
        type: 'collapsible',
        icon: 'briefcase',
        children: [
          {
            id: 'edit',
            title: 'Datos',
            translate: 'MENU.APPS.COMPANY.EDIT',
            type: 'item',
            icon: 'circle',
            url: 'manager/company/index'
          },
          {
            id: 'branch',
            title: 'Sucursales',
            translate: 'MENU.APPS.COMPANY.BRANCH',
            type: 'item',
            icon: 'circle',
            url: 'manager/branch/list'
          },
          {
            id: 'sales',
            title: 'Puntos de venta',
            translate: 'MENU.APPS.COMPANY.SALES',
            type: 'item',
            icon: 'circle',
            url: 'manager/sales/list'
          }
        ]
      },
      {
        id: 'zonessales',
        title: 'Zonas comerciales',
        translate: 'MENU.APPS.ZONESALE',
        type: 'item',
        icon: 'framer',
        url: 'manager/zone-sale/list'
      },
      {
        id: 'users',
        title: 'Usuarios',
        translate: 'MENU.APPS.USER',
        type: 'item',
        icon: 'user',
        url: 'manager/user/list'
      },
    ]
  }
];
