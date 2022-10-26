export class RequestDomain {
    id!: string;
    fullname!: string;
    email!: string;
    password!: string;
    domain_name!: string;
    company_name!: string;
    maxUserService!: any[];
    service!: any[];
    clear(): void {
        this.id = '';
        this.fullname = '';
        this.email = '';
        this.password = '';
        this.domain_name = '';
        this.company_name = '';
    }

}


