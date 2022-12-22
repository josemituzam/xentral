export class IspPlan {
    id !: string;
    name!: string;
    description!: string;
    increase!: number;
    type_increase!: string;
    downfall!: number;
    type_downfall!: string;
    compartition!: string;
    last_mile_id !: string;
    installation_cost !: number;
    month_cost !: number;
    penalty_amount !: number;
    meters_free !: number;
    additional_meter_cost!: number;
    minimun_permanence_id !: string;


    clear(): void {
        this.id = null;
        this.name = null;
        this.description = '';
        this.increase = 0;
        this.type_increase = null;
        this.downfall = 0;
        this.type_downfall = null;
        this.compartition = null;
        this.last_mile_id = null;
        this.installation_cost = 0;
        this.month_cost = 0;
        this.penalty_amount = 0;
        this.meters_free = 0;
        this.additional_meter_cost = 0;
        this.minimun_permanence_id = null;
    }
}


