(function($) {
    function initFeatherIcons() {
        feather.replace();
    }
    
    // Initialize on load
    initFeatherIcons();
    
    // Handle icon picker
    $(document).on("click", ".acf-feather-icon-picker .icon-selector-button", function(e) {
        e.preventDefault();
        const $picker = $(this).closest(".acf-feather-icon-picker");
        const $modal = $picker.find(".icon-picker-modal");
        
        // Add backdrop
        $("body").append('<div class="modal-backdrop"></div>');
        
        // Show modal
        $modal.show();
    });
    
    // Handle icon search and category filter
    function filterIcons() {
        const searchTerm = $(".icon-search").val().toLowerCase();
        const category = $(".icon-category-filter").val();
        const $icons = $(".icon-item");
        
        $icons.each(function() {
            const iconName = $(this).data("icon").toLowerCase();
            const iconCategory = $(this).data("category");
            const matchesSearch = iconName.includes(searchTerm);
            const matchesCategory = category === "all" || iconCategory === category;
            
            $(this).toggle(matchesSearch && matchesCategory);
        });
    }
    
    // Update event handlers
    $(document).on("input", ".icon-search", filterIcons);
    $(document).on("change", ".icon-category-filter", filterIcons);
    
    // Handle icon selection
    $(document).on("click", ".icon-item", function() {
        const $picker = $(this).closest(".acf-feather-icon-picker");
        const $input = $picker.find("input[type=hidden]");
        const $button = $picker.find(".icon-selector-button");
        const iconName = $(this).data("icon");
        
        // Update hidden input
        $input.val(iconName).trigger("change");
        
        // Update button icon
        $button.html('<i data-feather="' + iconName + '"></i>');
        
        // Add has-value class
        $picker.addClass("has-value");
        
        // Update selected state
        $(this).siblings().removeClass("selected");
        $(this).addClass("selected");
        
        // Close modal
        closeModal($picker);
        
        // Reinit icons
        initFeatherIcons();
    });
    
    // Handle clear icon click
    $(document).on("click", ".clear-icon-button", function(e) {
        e.stopPropagation();
        const $picker = $(this).closest(".acf-feather-icon-picker");
        const $input = $picker.find("input[type=hidden]");
        const $button = $picker.find(".icon-selector-button");
        
        // Clear the value
        $input.val("").trigger("change");
        
        // Reset button to show text
        $button.html('<span class="no-icon-text">' + acf_feather_icon.i18n.select_icon + '</span>');
        
        // Remove has-value class
        $picker.removeClass("has-value");
        
        // Remove selected state from icons
        $picker.find(".icon-item").removeClass("selected");
    });
    
    // Close modal on backdrop or close button click
    $(document).on("click", ".modal-backdrop, .close-modal", function() {
        const $picker = $(this).closest(".acf-feather-icon-picker");
        closeModal($picker);
    });
    
    function closeModal($picker) {
        $picker.find(".icon-picker-modal").hide();
        $(".modal-backdrop").remove();
    }
    
    // Close modal on escape key
    $(document).keyup(function(e) {
        if (e.key === "Escape") {
            $(".icon-picker-modal").hide();
            $(".modal-backdrop").remove();
        }
    });
})(jQuery); 