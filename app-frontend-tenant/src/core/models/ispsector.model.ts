export class IspSector {
    id !: string;
    name!: string;
    description!: string;
    latitude!: string;
    longitude !: string;
    is_active !: Boolean;
    created_by!: string;
    updated_by!: string;
    deleted_by!: string;
    short_code!: string;
    long_code !: string;
    isp_parish_id!: string;
    

    clear(): void {
        this.id = null;
        this.name = null;
        this.description = '';
        this.latitude = '';
        this.longitude = '';
        this.is_active = false;
        this.created_by = '';
        this.updated_by = '';
        this.deleted_by = '';
        this.short_code = '';
        this.long_code = '';
        this.isp_parish_id = "";

    }

}