import $ from 'jquery';
import daterangepicker from 'daterangepicker'

class AjaxPaginationFilters {
    constructor() {
        this.start_date = false;
        this.end_date = false;
        this.search_text = false;
        this.nonce = $('.js--table-content').data('ciNonce');
        this.load_posts(1);
        this.events();
    }

    events() {
        $('.js--table-content').on('click', 'li.active' , this.change_page.bind(this));
        $('.js--filter').on('click', this.change_filter.bind(this));
        $('#js--date-from').on('apply.daterangepicker', this.change_date.bind(this));
        $('#js--date-from').on('cancel.daterangepicker', this.clear_date.bind(this));
        $('#js--invoice-search').on('keyup', this.search.bind(this));
    }

    change_date(e, picker) {
        $(e.target).val(picker.startDate.format('DD/MM/YYYY') + ' ⇨ ' + picker.endDate.format('DD/MM/YYYY'));
        this.start_date = picker.startDate.format('YYYYMMDD');
        this.end_date = picker.endDate.format('YYYYMMDD');
        this.load_posts(1);
    }

    clear_date(e) {
        $(e.target).val('');
        this.start_date = false;
        this.end_date = false;
        this.load_posts(1);
    }

    change_filter(e) {
        let filterButtons = $(".js--filter");
        let currentFilter = $(e.target);

        filterButtons.removeClass("filters__status-filter--active");
        currentFilter.addClass("filters__status-filter--active");

        let activeFilter = $('.filters__status-filter--active').data('filter');
        this.load_posts(1, activeFilter);
    }

    change_page(e) {
        let currentPage = $(e.target);
        let page = currentPage.attr("p");
        this.load_posts(page);
    }

    search(e) {
        this.search_text = $(e.target).val();
        this.load_posts(1);
    }

    load_posts(page, activeFilter = false){

        if ( !activeFilter  ) {
            activeFilter = $('.filters__status-filter--active').data('filter');
        }

        var data = {
            page: page,
            filter: activeFilter,
            start_date: this.start_date,
            end_date: this.end_date,
            search_text : this.search_text,
            nonce : this.nonce,
            action : "ci_invoices_pagination"
        };

        $.post(ciInvoiceData.ajaxUrl, data, function(response) {

            if(response.success){

                $('.js--table-content').html('').append(response.data.table);

                $('.js--row').fadeTo('fast', 1);
            }
        });
    }
}

export default AjaxPaginationFilters
