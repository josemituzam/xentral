export class IspPlan {
    id !: string;
    name!: string;
    description!: string;
    increase!: string;
    type_increase!: string;
    downfall!: string;
    type_downfall!: string;
    compartition!: string;
    last_mile_id !: string;
    installation_cost !: string;
    month_cost !: string;
    penalty_amount !: string;
    meters_free !: string;
    additional_meter_cost!: string;
    minimun_permanence_id !: string;


    clear(): void {
        this.id = null;
        this.name = null;
        this.description = null;
        this.increase = null;
        this.type_increase = null;
        this.downfall = null;
        this.type_downfall = null;
        this.compartition = null;
        this.last_mile_id = null;
        this.installation_cost = null;
        this.month_cost = null;
        this.penalty_amount = null;
        this.meters_free = null;
        this.additional_meter_cost = null;
        this.minimun_permanence_id = null;
    }
}


