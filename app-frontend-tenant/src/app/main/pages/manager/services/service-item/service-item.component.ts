import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';

import { EcommerceService } from 'app/main/apps/ecommerce/ecommerce.service';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';

@Component({
  selector: 'app-service-item',
  templateUrl: './service-item.component.html',
  styleUrls: ['./service-item.component.scss'],
  encapsulation: ViewEncapsulation.None,
  host: { class: 'service-application' }
})
export class ServiceItemComponent implements OnInit {
  // Input Decorotor
  @Input() service;
  @Input() isWishlistOpen = false;

  // Public
  public isInCart = false;

  /**
   *
   * @param {EcommerceService} _ecommerceService
   */
  constructor(private _ecommerceService: EcommerceService, private router: Router, private activatedRoute: ActivatedRoute) { }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  /**
   * Toggle Wishlist
   *
   * @param service
   */
  toggleWishlist(service) {
    if (service.isInWishlist === true) {
      this._ecommerceService.removeFromWishlist(service.id).then(res => {
        service.isInWishlist = false;
      });
    } else {
      this._ecommerceService.addToWishlist(service.id).then(res => {
        service.isInWishlist = true;
      });
    }
  }

  /**
   * Add To Cart
   *
   * @param service
   */
  addToCart(service) {
    this._ecommerceService.addToCart(service.id).then(res => {
      service.isInCart = true;
    });
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  ngOnInit(): void {
    //console.log("hola");
  }


  url(url: any): void {
    console.log("goBackWithoutId...");
    console.log(url);
    this.router.navigate(['../../' + url + '/dashboard'], { relativeTo: this.activatedRoute }).then(() => {
      location.reload();
    });
    //this.router.navigateByUrl(baseUrl + url + '/dashboard');

  }
}
