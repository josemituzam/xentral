
export class Branch {
    id!: string;
    name!: string;
    description!: string;
    code!: string;
    address!: string;
    phone!: string;
    extention!: string;
    email!: string;


    clear(): void {
        this.id = undefined;
        this.name = null;
        this.description = null;
        this.code = null;
        this.address = null;
        this.phone = null;
        this.extention = null;
        this.email = null;
    }
}



