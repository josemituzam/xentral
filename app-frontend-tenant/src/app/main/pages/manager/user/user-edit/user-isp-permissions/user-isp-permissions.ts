import { Component, OnInit, OnDestroy, Input, ViewEncapsulation, ChangeDetectorRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormBuilder, FormArray, FormControl } from '@angular/forms';
import { ZoneSale } from 'core/models/manager/zone-sale.model';
import { AbstractControl, Validators } from '@angular/forms';
import { Subject, of, Subscription, Observable } from 'rxjs';
import { catchError, delay, finalize, tap } from 'rxjs/operators';
import Swal from 'sweetalert2'
import { SalesService } from 'core/services/manager/sales.service';
import { Sales } from 'core/models/manager/sales.model';
import { UserDetailService } from 'core/services/manager/user-detail.service';

@Component({
    selector: 'app-user-isp-permissions',
    templateUrl: './user-isp-permissions.html',
    styleUrls: ['./user-isp-permissions.scss'],
    encapsulation: ViewEncapsulation.None
})
export class UserIspPermissionsComponent implements OnInit, OnDestroy {
    // Public
    public url = this.router.url;
    public urlLastValue;
    public rows;
    public currentRow;
    public tempRow;
    public contentHeader: object
    editForm: FormGroup;
    itemModel: Sales;
    loading = false;
    private _unsubscribeAll: Subject<any>;
    subscriptions: Subscription[] = [];
    @Input() userId: string;

    /**
     * Constructor
     *
     * @param {Router} router
     * @param {UserEditService} _userEditService
     */
    constructor(private cdr: ChangeDetectorRef, private _service: UserDetailService, private router: Router, private fb: FormBuilder, private activatedRoute: ActivatedRoute) {
        this._unsubscribeAll = new Subject();
        this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
    }

    // Public Methods
    // -----------------------------------------------------------------------------------------------------

    initForm() {
        this.editForm = this.fb.group({
            permission: this.fb.array([]),
        });
    }

    cbxUserPermission(value: string, cbxChecked: boolean) {
        const permission = <FormArray>this.editForm.controls.permission;
        if (cbxChecked) {
            permission.push(new FormControl(value));
        } else {
            let index = permission.controls.findIndex(x => x.value == value)
            permission.removeAt(index);
        }
    }

    prepareItem(): any {
        const controls = this.editForm.controls;
        let item = {
            permission: controls['permission'].value,
            userId: this.userId
        }
        return item;
    }


    // Lifecycle Hooks
    // -----------------------------------------------------------------------------------------------------
    /**
     * On init
     */
    ngOnInit(): void {
        this.initForm();
        this.getUserPermission(this.userId)
    }


    submit() {
        this.loading = true;
        const editedItem = this.prepareItem();
        this.addItem(editedItem);
    }

    permissionList: any[];

    getUserPermission(userId: string) {
        this._service.getUserPermission(userId).subscribe(res => {
            if (res) {
                this.permissionList = res;
                res.forEach(element => this.cbxUserPermission(element, true));
                // const permission = <FormArray>this.editForm.controls.permission;
                // res.forEach(element => permission.push(new FormControl(element)));
                this.cdr.detectChanges();
            }
        }
            , err => {
                console.log("Estatus: ", err);
            }
        );
    }

    hasPermission(value: string) {
        return this.permissionList?.includes(value) ? true : false;
    }



    addItem(_item: any) {
        this._service.userPermission(_item).subscribe((res: any) => {
            if (res) {
                this.permissionList = res.permission;
                const arr = <FormArray>this.editForm.controls.permission;
                arr.controls = [];
                this.getUserPermission(this.userId);
                this.setMessageSuccess(`Se han actualizado los permisos correctamente.`)
                this.loading = false;
            }
        }, err => {
            let title = `Ocurrió un error`;
            let type = `error`;
            if (err.status == 400) {
                title = `Alerta`;
                type = `warning`;
            }
            this.loading = false;
        }
        );
    }



    setMessageSuccess(message: string) {
        Swal.fire({
            icon: 'success',
            title: `${message}`,
            showConfirmButton: false,
            timer: 1500
        })
    }

    /*
     * On destroy
     */
    ngOnDestroy(): void {
        // Unsubscribe from all subscriptions
        this._unsubscribeAll.next();
        this._unsubscribeAll.complete();
    }


}
