export class TemplateContract {
    id !: string;
    name !: string;
    template_code !: string;
    orientation !: string;
    html !: string;
    margin_bottom !: string;
    margin_left !: string;
    margin_top!: string;
    margin_right!: string;
    size!: string;
    orderBy!: string;

    clear(): void {
        this.id = null;
        this.name = null;
        this.template_code = null;
        this.orientation = null;
        this.html = null;
        this.margin_bottom = null;
        this.margin_left = null;
        this.margin_top = null;
        this.margin_right = null;
        this.size = null;
        this.orderBy = null;
    }
}


