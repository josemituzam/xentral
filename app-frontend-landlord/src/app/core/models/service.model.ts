export class Service {
    id!: string;
    name!: string;
    description!: string;
    service_detail!: [];

    clear(): void {
        this.id = '';
        this.name = '';
        this.description = '';
        this.service_detail = [];
    }

}


