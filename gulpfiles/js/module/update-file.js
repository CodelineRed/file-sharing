/*global initDataTable*/
'use strict';

/**
 * Init update file modal
 * 
 * @returns {undefined}
 */
function initUpdateFile() {
    (function($) {
        // 1: label, 2: value, 3: checked attribute, 4: access icon
        let btnFolderTpl = '<label class="btn btn-primary btn-sm me-2 mb-2">%s <input value="%s" type="checkbox" class="d-none update-file-folder" %s/><i class="fas fa-fw fa-check"></i><i class="fas fa-fw fa-times"></i> <i class="fas fa-%s"></i></label>';

        // 1: button class, 2: label, 3: value, 4: checked attribute, 5: access icon
        let btnAccessTpl = '<label class="btn btn-%s btn-sm me-2 mb-2">%s <input value="%s" type="radio" class="d-none update-file-access" name="update_file_access" %s/><i class="fas fa-fw fa-check"></i><i class="fas fa-fw fa-times"></i> <i class="fas fa-%s"></i></label>';

        $('#update-file').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let modal = $(this);

            modal.find('.btn-group-folder').html('<span class="placeholder col-6"></span>');
            modal.find('.btn-group-access').html('<span class="placeholder col-6"></span>');
            modal.find('button.submit-form').prop('disabled', true);
            modal.find('.btn-create-folder').attr('data-file-id', '');
            modal.find('#update-file-name').val('');
            modal.find('#update-file-note').val('');

            $.ajax({
                url: button.data('get-file'),
                method: 'get',
                dataType: 'json'
            }).done(function(data) {
                if (typeof data.result === 'boolean' && data.result === true) {
                    modal.find('button.submit-form').prop('disabled', false);
                    modal.find('#update-file-name').val(data.name);
                    modal.find('#update-file-note').val(data.note);
                    modal.find('.btn-create-folder').attr('data-file-id', data.id);
                    modal.find('.btn-group-folder > .btn').remove();
                    modal.find('.btn-group-access > .btn').remove();
                    modal.find('#update-file-name').trigger('keyup');

                    if (typeof data.folders === 'object' && Object.keys(data.folders).length) {
                        modal.find('.btn-group-folder').html('');
                        $.each(data.folders, function(index, folder){
                            modal.find('.btn-group-folder').append(btnFolderTpl.format(folder.name, folder.id, (folder.selected ? 'checked' : ''), folder.access_icon));
                        });
                    }

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

                let file = {
                    name: modal.find('#update-file-name').val(),
                    note: modal.find('#update-file-note').val(),
                    access: modal.find('input.update-file-access:checked').val(),
                    folders: (function() {
                        let folders = []; // eslint-disable-line array-bracket-newline
                        modal.find('input.update-file-folder:checked').each(function() {
                            folders.push($(this).val());
                        });
                        return folders;
                    })()
                };

                modal.find('button.submit-form').prop('disabled', true);

                $.ajax({
                    url: button.data('update-file'),
                    method: 'post',
                    dataType: 'json',
                    data: file
                }).done(function(data) {
                    if (typeof data.result === 'boolean' && data.result === true) {
                        $('#file-' + button.data('file-id') + ' .detail-link').text(data.name);
                        $('#file-' + button.data('file-id') + ' .td-access').attr('data-order', data.access);
                        $('#file-' + button.data('file-id') + ' .btn-access i').attr('class', 'fas fa-fw fa-' + data.access_icon);
                        $('#file-' + button.data('file-id') + ' .btn-access').attr('class', 'btn btn-sm btn-access me-2 btn-' + data.access_button);
                        $('.data-table').DataTable().destroy();
                        initDataTable();
                        $('#update-file').modal('hide');
                    }
                }).always(function() {
                    modal.find('button.submit-form').prop('disabled', false);
                });
            });

            modal.find('#update-file-name').unbind('keyup');
            modal.find('#update-file-name').bind('keyup', function(){
                if ($(this).val().length > 2) {
                    $(this).removeClass('is-invalid');
                } else {
                    $(this).addClass('is-invalid');
                }
            });
        });
    })(jQuery);
}
