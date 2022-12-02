export class IspSector {
    id !: string;
    sector!: any;
    location!: any;
    latitude!: string;
    longitude !: string;
    city !: string;
    state !: string;
    clear(): void {
        this.id = null;
        this.sector = null;
        this.location = null;
        this.latitude = null;
        this.longitude = null;
        this.city = null;
        this.state = null;
    }
}