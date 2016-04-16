$(function() {
    var $modal = $('#modal-ajax-view');

    if ($modal.length) {
        var modalView = new ModalView($modal);

        $('.modal-view-button').click(function(event) {
            event.preventDefault();
            modalView.displayItem($(this).attr('href'));
        });
    }
});