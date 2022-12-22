
export class Company {
    id!: string;
    name_company!: string;
    name_commercial!: string;
    type_identification!: string;
    identification!: string;
    is_accounting!: boolean;
    is_special!: boolean;
    address!: string;
    phone_principal!: string;
    phone_secondary!: string;
    break_day!: string;
    decimal!: string;
    google_key!: string;
    electronic_signature!: string;

    clear(): void {
        this.id = undefined;
        this.name_company = null;
        this.name_commercial = null;
        this.type_identification = null;
        this.identification = null;
        this.is_accounting = false;
        this.is_special = false;
        this.address = null;
        this.phone_principal = null;
        this.phone_secondary = null;
        this.break_day = null;
        this.decimal = null;
        this.google_key = null;
        this.electronic_signature = null;
    }
}




