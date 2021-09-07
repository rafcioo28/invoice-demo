import $ from 'jquery';
import daterangepicker from 'daterangepicker'
class DateFilter {
    constructor() {
        this.datePickerInit();
    }

    //methods
    datePickerInit() {
        let dateField = $('#js--date-from');
        dateField.daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });
    }
}

export default DateFilter