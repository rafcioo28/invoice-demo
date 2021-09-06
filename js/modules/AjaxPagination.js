import $ from 'jquery';

class AjaxPagination {
    constructor() {
        this.load_all_posts(1);
        this.events();
    }
  
    events() {
        $('.invoice-table__container').on('click', 'li.active' , this.load_all_posts);
    }

    load_all_posts(page){
        if ( page != 1 ) {
            page = $(this).attr('p');
        }
        console.log(page)
        // Start the transition
        $(".cvf_pag_loading").fadeIn().css('background','#ccc');

        // Data to receive from our server
        // the value in 'action' is the key that will be identified by the 'wp_ajax_' hook
        var data = {
            page: page,
            action: "ci_invoices_pagination"
        };

        // Send the data
        $.post(ciInvoiceData.ajaxUrl, data, function(response) {
            // If successful Append the data into our html container
            $('.js--row').remove();
            $('.ci-pagination').remove();
            $(".invoice-table__container").append(response);
            // End the transition
            $(".invoice-table__container").css({'background':'none', 'transition':'all 1s ease-out'});
        });
    }
}

export default AjaxPagination
