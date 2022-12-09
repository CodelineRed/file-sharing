/*global initDataTable*/
'use strict';

/**
 * Init update folder modal
 * 
 * @returns {undefined}
 */
function initUpdateFolder() {
    (function($) {
        // 1: button class, 2: label, 3: value, 4: checked attribute, 5: access icon
        let btnAccessTpl = '<label class="btn btn-%s btn-sm me-2 mb-2">%s <input value="%s" type="radio" class="update-folder-access d-none" name="update_folder_access" %s/><i class="fas fa-fw fa-check"></i><i class="fas fa-fw fa-times"></i> <i class="fas fa-%s"></i></label>';

        $('#update-folder').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let modal = $(this);

            modal.find('.btn-group-access').html('<span class="placeholder col-6"></span>');
            modal.find('button.submit-form').prop('disabled', true);
            modal.find('#update-folder-name').val('');
            modal.find('#update-folder-note').val('');

            $.ajax({
                url: button.data('get-folder'),
                method: 'get',
                dataType: 'json'
            }).done(function(data) {
                if (typeof data.result === 'boolean' && data.result === true) {
                    modal.find('button.submit-form').prop('disabled', false);
                    modal.find('#update-folder-name').val(data.name);
                    modal.find('.btn-group-access > .btn').remove();
                    modal.find('#update-folder-name').trigger('keyup');

                    if (typeof data.access_list === 'object' && Object.keys(data.access_list).length) {
                        modal.find('.btn-group-access').html('');
                        $.each(data.access_list, function(index, access){
                            modal.find('.btn-group-access').append(btnAccessTpl.format(access.button, access.trans, access.id, (data.access === access.id ? 'checked' : ''), access.icon));
                        });
                    }
                }
            });

            modal.find('.modal-body form').submit(function(submitEvent) {
                submitEvent.preventDefault();
                modal.find('button.submit-form').click();
            });

            modal.find('button.submit-form').unbind('click');
            modal.find('button.submit-form').click(function() {
                if (modal.find('.is-invalid').length) {
                    return;
                }

                let folder = {
                    name: modal.find('#update-folder-name').val(),
                    access: modal.find('input.update-folder-access:checked').val()
                };

                modal.find('button.submit-form').prop('disabled', true);

                $.ajax({
                    url: button.data('update-folder'),
                    method: 'post',
                    dataType: 'json',
                    data: folder
                }).done(function(data) {
                    if (typeof data.result === 'boolean' && data.result === true) {
                        $('#folder-' + button.data('folder-id') + ' .detail-link').text(data.name);
                        $('#folder-' + button.data('folder-id') + ' .td-access').attr('data-order', data.access);
                        $('#folder-' + button.data('folder-id') + ' .btn-access i').attr('class', 'fas fa-fw fa-' + data.access_icon);
                        $('#folder-' + button.data('folder-id') + ' .btn-access').attr('class', 'btn btn-sm btn-access me-2 btn-' + data.access_button);
                        $('.data-table').DataTable().destroy();
                        initDataTable();
                        $('#update-folder').modal('hide');
                    }
                }).always(function() {
                    modal.find('button.submit-form').prop('disabled', false);
                });
            });

            modal.find('#update-folder-name').unbind('keyup');
            modal.find('#update-folder-name').bind('keyup', function(){
                if ($(this).val().length > 2) {
                    $(this).removeClass('is-invalid');
                } else {
                    $(this).addClass('is-invalid');
                }
            });
        });
    })(jQuery);
}
