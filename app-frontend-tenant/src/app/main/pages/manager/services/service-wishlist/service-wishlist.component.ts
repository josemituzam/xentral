import {
  Component,
  OnInit,
  ViewEncapsulation,
  Input,
  OnDestroy,
  ChangeDetectorRef,
  ChangeDetectionStrategy,
} from '@angular/core';
import { Service } from 'core/models/service.model';
import { ServiceService } from 'core/services';

@Component({
  selector: 'app-service-wishlist',
  templateUrl: './service-wishlist.component.html',
  styleUrls: ['./service-wishlist.component.scss'],
  encapsulation: ViewEncapsulation.None,
  host: { class: 'ecommerce-application' }
})
export class ServiceWishlistComponent implements OnInit {
  // Public
  public contentHeader: object;
  public products;
  public wishlist;
  serviceList: Service[];

  /**
   *
   * @param {EcommerceService} _ecommerceService
   */
  constructor(private _service: ServiceService, private cdr: ChangeDetectorRef) { }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------

  /**
   * On init
   */
  ngOnInit(): void {
    this.getServices();
    // content header
    this.contentHeader = {
      headerTitle: 'Servicios',
      actionButton: true,
      breadcrumb: {
        type: '',
        links: [
          {
            name: 'Mis servicios',
            isLink: false,
            link: '/'
          },

        ]
      }
    };
  }

  /**
   * Método para obtener la lista de los servicios
   */
  getServices() {
    this._service
      .getServices()
      .subscribe((res: any) => {
        if (res) {
          this.serviceList = res;
          console.log(this.serviceList);
          this.cdr.detectChanges();
        }
      });
  }
}
