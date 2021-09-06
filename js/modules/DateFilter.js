import $ from 'jquery';
import daterangepicker from 'daterangepicker'


class DateFilter {
    constructor() {
        this.datePickerInit();
        this.events();
    }
  
    events() {
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

        dateField.on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' ⇨ ' + picker.endDate.format('MM/DD/YYYY'));
        });

        dateField.on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    }

  }
  
  export default DateFilter