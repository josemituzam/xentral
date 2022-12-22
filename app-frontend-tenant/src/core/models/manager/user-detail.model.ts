
export class UserDetail {
    id!: string;
    firstname !: string;
    lastname !: string;
    type_identification!: string;
    identification!: string;
    birthday_at!: string;
    phone!: string;
    address!: string;
    email!: string;
    cant_extra_time!: string;
    day_extra_time!: string;
    zone_sale_id!: string;
    description!: string;
    clear(): void {
        this.id = undefined;
        this.firstname = null;
        this.lastname = null;
        this.type_identification = null;
        this.identification = null;
        this.birthday_at = null;
        this.phone = null;
        this.address = null;
        this.email = null;
        this.cant_extra_time = null;
        this.day_extra_time = null;
        this.zone_sale_id = null;
        this.description = null;
    }
}



