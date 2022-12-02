export class IspContract {

    id !: string;
    emission_at!: any;
    plan_id!: string;
    break_at !: string;
    customer_id !: string;
    username !: string;
    sector_id !: string;
    address_contract !: string;
    contract_version_id !: string;
    payment_id !: string;
    adviser_id !: string;

    last_mile_id!: string;

    is_permanence_cost !: boolean;
    permanence_cost!: string;

    is_reconnection_cost !: boolean;
    reconnection_cost !: string;
    is_from_another_provider !: boolean;
    another_provider_id !: string;
    is_pay_to_invoice!: boolean;
    is_apply_arcotel !: boolean;
    is_not_cut_for_debt !: boolean;
    is_not_generate_invoice_service !: boolean;

    compartition !: string;
    minimun_permanence_id !: string;
    installation_cost !: string;
    month_cost !: string;

    clear(): void {
        this.id = undefined;
        this.emission_at = null;
        this.plan_id = null;
        this.break_at = null;
        this.customer_id = null;
        this.username = null;
        this.sector_id = null;
        this.address_contract = null;
        this.contract_version_id = null;
        this.payment_id = null;
        this.adviser_id = null;

        this.is_permanence_cost = true;
        this.permanence_cost = null;

        this.is_reconnection_cost = false;
        this.reconnection_cost = null;
        this.is_from_another_provider = false;
        this.another_provider_id = null;
        this.is_pay_to_invoice = false;
        this.is_apply_arcotel = false;
        this.is_not_cut_for_debt = false;
        this.is_not_generate_invoice_service = true;

        this.compartition = null;
        this.minimun_permanence_id = null;
        this.installation_cost = null;
        this.month_cost = null;

    }
}