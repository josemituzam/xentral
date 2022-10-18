export class RequestDomain {
    firstname!: string;
    lastname!: string;
    email!: string;
    password!: string;
    domain_name!: string;
    company_name!: string;

    clear(): void {
        this.firstname != '';
        this.lastname != '';
        this.email != '';
        this.password != '';
        this.domain_name != '';
        this.company_name != '';
    }

}


