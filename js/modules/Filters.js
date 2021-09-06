import $ from 'jquery';

class Filters {
    constructor() {
        this.events();
    }

    events() {
        $(".js--filter").on("click", this.setFilter);
    }

    setFilter(e) {
        let filterButtons = $(".js--filter");
        let currentFilter = $(e.target);

        filterButtons.removeClass("filters__status-filter--active");
        currentFilter.addClass("filters__status-filter--active");

    }
}

export default Filters
