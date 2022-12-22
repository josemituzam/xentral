export class Sales {
    id!: string;
    branch_id!: string;
    description!: string;
    is_apply_invoice!: boolean;
    sequential_init!: string;
    code !: string;

    clear(): void {
        this.id = undefined;
        this.branch_id = null;
        this.description = null;
        this.is_apply_invoice = false;
        this.sequential_init = null;
        this.code = null;
    }
}

