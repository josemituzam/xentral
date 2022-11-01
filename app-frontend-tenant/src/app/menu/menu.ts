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
    url: 'dashboard/analytics'
  },
  // Apps & Pages
  {
    id: 'apps',
    type: 'section',
    title: 'Apps & Pages',
    translate: 'MENU.APPS.SECTION',
    icon: 'package',
    children: [
      {
        id: 'companies',
        title: 'Company',
        translate: 'MENU.APPS.COMPANY.COLLAPSIBLE',
        type: 'collapsible',
        icon: 'briefcase',
        children: [
          {
            id: 'edit',
            title: 'Edit',
            translate: 'MENU.APPS.COMPANY.EDIT',
            type: 'item',
            icon: 'circle',
            url: 'manager/company'
          },
          {
            id: 'branch',
            title: 'Branch',
            translate: 'MENU.APPS.COMPANY.BRANCH',
            type: 'item',
            icon: 'circle',
            url: 'manager/branch/list'
          },
          {
            id: 'sales',
            title: 'Sales',
            translate: 'MENU.APPS.COMPANY.SALES',
            type: 'item',
            icon: 'circle',
            url: 'manager/sales/list'
          }
        ]
      },
      /*{
        id: 'companies',
        title: 'Company',
        translate: 'MENU.APPS.COMPANY',
        type: 'item',
        icon: 'user',
        url: 'apps/user/user-list'
      }, */
      {
        id: 'users',
        title: 'User',
        translate: 'MENU.APPS.USER',
        type: 'item',
        icon: 'user',
        url: 'manager/user/list'
      },
    ]
  }
];
