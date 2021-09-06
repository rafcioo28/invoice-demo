import $ from 'jquery';

class Checkboxes {
    constructor() {
        this.events();
    }

    events() {
        $(".js--row").on("click", this.rowClick);
        $(".js--select-all").on("click", this.selectAll);
    }

    //methods
    rowClick(e) {
        let currentRow = ($(e.target).closest(".js--row"));
        let currentCheckbox = $(currentRow).find(":checkbox");

        currentCheckbox.prop('checked', !currentCheckbox.prop('checked'));
        $(".js--select-all").find(":checkbox").prop('checked', false);
    }

    selectAll(){
        let allCheckbox = $(".invoice-table").find(":checkbox");

        if ($(".js--select-all").find(":checkbox").is(":checked")) {
            allCheckbox.prop('checked', false);
        } else {
            allCheckbox.prop('checked', true);
        }
    }
}

export default Checkboxes;