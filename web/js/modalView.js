var ModalView = function($modal) {
    this.$modal = $modal;

    this.displayItem = function(url) {
        var self = this;

        requestData(url, function(data) {
            self.$modal.find('.modal-body').html(data);
            self.$modal.modal();
        });
    };

    var requestData = function(url, callback) {
        var self = this;

        $.ajax({
            url: url,
            type: 'GET',

            success: function(data) {
                if (data) {
                    callback.call(self, data);
                }
            },

            error: function(jqXHR, textStatus) {
                console.log(textStatus);
            }
        });
    };
};