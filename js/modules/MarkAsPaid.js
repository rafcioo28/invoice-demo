import $ from 'jquery';

class MarkAsPaid {
    constructor() {
        this.events();
    }
  
    events() {
        $('.js--paid').on('click', this.button_click.bind(this));

    }
  
    button_click(){
        this.set_as_paid();
    }

    set_as_paid() {
        let selectedRows = $('.js--table-content').find(':checkbox:checked');


        let invoiceIds = [];
        selectedRows.each(function(){
            let ids =  $(this).data('invoiceId');
            invoiceIds.push(ids);
        });

        let data = {
            invoice_array: invoiceIds.join(', '),
            action : "ci_paid_invoice"
        };

        if ( invoiceIds.length ) {
            $.post(ciInvoiceData.ajaxUrl, data, function(response) {
                invoiceIds.forEach( function(ids) {
                    let row = $(":checkbox[data-invoice-id='" + ids +"']").closest(".js--row");
                    let restaurantCellPaid = row.find(".invoice-table__paid");

                    if ( !restaurantCellPaid.length ) {
                        row.find(".invoice-table__restaurant").append( '<span class="invoice-table__paid">paid</span>' );
                    }
                } );
                
            });
        }
    }
}

export default MarkAsPaid
