'use strict';

/**
 * Init edit file modal
 * 
 * @returns {undefined}
 */
function initEditFile() {
    (function($) {
        $('#edit-file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            modal.find('.modal-footer button.submit-form').prop('disabled', true);

            $.ajax({
                url: button.data('file-show'),
                method: 'get',
                dataType: 'json'
            })
                .done(function(data) {
                    if (typeof data.result === 'boolean' && data.result === true) {
                        modal.find('.modal-body input#edit-file-name').val(data.name);
                        modal.find('.modal-footer button.submit-form').prop('disabled', false);
                    }
                });
                
            
            modal.find('.modal-body form').submit(function(submitEvent) {
                submitEvent.preventDefault();
                modal.find('.modal-footer button.submit-form').click();
            });

            modal.find('.modal-footer button.submit-form').unbind('click');
            modal.find('.modal-footer button.submit-form').click(function() {
                var file = {
                    name: modal.find('#edit-file-name').val()
                };

                modal.find('.modal-footer button.submit-form').prop('disabled', true);

                $.ajax({
                    url: button.data('file-update'),
                    method: 'post',
                    dataType: 'json',
                    data: file
                })
                    .done(function(data) {
                        if (typeof data.result === 'boolean' && data.result === true) {
                            $('#file-' + button.data('fileid') + ' .detail-link').text(file.name);
                            $('#edit-file').modal('hide');
                        }
                    })
                    .always(function() {
                        modal.find('.modal-footer button.submit-form').prop('disabled', false);
                    });
            });
        });
    })(jQuery);
}
