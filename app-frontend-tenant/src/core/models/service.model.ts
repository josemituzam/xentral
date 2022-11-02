export class Service {
    id!: string;
    name!: string;
    description!: string;
    icon!: string;
    url!: string;
    photo!: string;
    service_detail!: [];

    clear(): void {
        this.id = '';
        this.name = '';
        this.description = '';
        this.icon= '';
        this.service_detail = [];
    }

}


