export class ZoneSale {
    id!: string;
    name!: string;
    code!: string;

    clear(): void {
        this.id = undefined;
        this.name = null;
        this.code = null;
    }
}


