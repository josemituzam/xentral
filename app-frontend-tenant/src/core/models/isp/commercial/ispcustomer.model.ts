export class IspCustomer {
    id !: string;
    type_people!: string;
    type_identification!: string;
    identification!: string;
    name_company!: string;
    firstname !: string;
    lastname !: string;
    started_at!: string;
    type_gender!: string;
    address!: string;
    type_number!: string;
    phone !: string;
    //phone_fixed !: number;
    email !: string;
    is_accounting!: Boolean;
    is_disability!: Boolean;
    is_old!: Boolean;
    is_bond!: Boolean;
    firstname_representative !: string;
    lastname_representative !: string;
    phone_representative !: string;
    photo !: string;

    contacts!: [];

    clear(): void {
        this.id = null;
        this.type_people = null;
        this.type_identification = null;
        this.identification = '';
        this.name_company = '';
        this.firstname = '';
        this.lastname = '';
        this.started_at = null;
        this.type_gender = null;
        this.address = '';
        this.type_number = null;
        this.phone = '0';
        //this.phone_fixed = null;
        this.email = '';
        this.is_accounting = false;
        this.is_disability = false;
        this.is_old = false;
        this.is_bond = false;
        this.firstname_representative = '';
        this.lastname_representative = '';
        this.phone_representative = '0';
        this.contacts = [];
        this.photo = '';

    }
}


