export class RequestDomain {
    id!: string;
    fullname!: string;
    email!: string;
    password!: string;
    domain_name!: string;
    url!: string;
    company_name!: string;
    maxContractService!: any[];
    domain_service !: any[];
    service!: any[];
    country !: string;
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


