
export class Note {
    id: string;
    note: string;
    module_short_code: string;
    reference_id: string;
    clear(): void {
        this.id = undefined;
        this.note = '';
        this.module_short_code = '';
        this.reference_id = '';
    }
}