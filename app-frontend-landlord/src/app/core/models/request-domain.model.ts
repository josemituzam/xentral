export class RequestDomain {
    id!: string;
    fullname!: string;
    email!: string;
    password!: string;
    domain_name!: string;
    url!: string;
    company_name!: string;
    maxUserService!: any[];
    service!: any[];
    clear(): void {
        this.id = '';
        this.fullname = '';
        this.email = '';
        this.url = '';
        this.password = '';
        this.domain_name = '';
        this.company_name = '';
    }

}


