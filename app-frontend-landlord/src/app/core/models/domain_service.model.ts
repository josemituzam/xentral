export class DomainService {
    request_domain_id !: string;
    maxContractService!: any[];
    clear(): void {
        this.request_domain_id = '';
        this.maxContractService = [];
    }

}


