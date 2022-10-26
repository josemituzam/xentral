import { CoreMenu } from '@core/types'

export const menu: CoreMenu[] = [
  {
    id: 'dashboard',
    title: 'Dashboard',
    translate: 'MENU.DASHBOARD',
    type: 'item',
    icon: 'home',
    url: 'home'
  },
  {
    id: 'charts-maps',
    type: 'section',
    title: 'Módulos',
    translate: 'MENU.MODULE.SECTION',
    icon: 'bar-chart-2',
    children: [
      {
        id: 'requestdomain',
        title: 'Solicitud de dominio',
        translate: 'MENU.MODULE.REQUESTDOMAIN',
        icon: 'git-pull-request',
        type: 'item',
        url: 'request-domain/list'
      },
      {
        id: 'service',
        title: 'Servicios',
        translate: 'MENU.MODULE.SERVICE',
        icon: 'command',
        type: 'item',
        url: 'service/list'
      }
    ]
  },
]
