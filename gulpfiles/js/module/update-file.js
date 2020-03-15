/*global initDataTable*/
'use strict';

/**
 * Init update file modal
 * 
 * @returns {undefined}
 */
function initUpdateFile() {
    (function($) {
        // 1: active class, 2: label, 3: access icon, 4: value, 5: checked attribute
        let btnFolderTpl = '<label class="btn btn-primary btn-sm mr-2 mb-2 %s">%s <i class="fas fa-fw fa-check"></i><i class="fas fa-fw fa-times"></i> <i class="fas fa-%s"></i><input value="%s" type="checkbox" class="update-file-folder" %s/></label>';
        
        // 1: button class, 2: active class, 3: label, 4: access icon, 5: value, 6: checked attribute
        let btnAccessTpl = '<label class="btn btn-%s btn-sm mr-2 mb-2 %s">%s <i class="fas fa-fw fa-check"></i><i class="fas fa-fw fa-times"></i> <i class="fas fa-%s"></i><input value="%s" type="radio" class="update-file-access" name="update_file_access" %s/></label>';
        
        $('#update-file').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let modal = $(this);
            
            modal.find('.modal-footer button.submit-form').prop('disabled', true);
            modal.find('.btn-create-folder').attr('data-file-id', '');
            modal.find('#update-file-name').val('');
            
            $.ajax({
                url: button.data('get-file'),
                method: 'get',
                dataType: 'json'
            })
                .done(function(data) {
                    if (typeof data.result === 'boolean' && data.result === true) {
                        modal.find('button.submit-form').prop('disabled', false);
                        modal.find('#update-file-name').val(data.name);
                        modal.find('.btn-create-folder').attr('data-file-id', data.id);
                        modal.find('.btn-group-folder > .btn').remove();
                        modal.find('.btn-group-access > .btn').remove();
                        
                        if (typeof data.folders === 'object' && Object.keys(data.folders).length) {
                            $.each(data.folders, function(index, folder){
                                modal.find('.btn-group-folder').append(btnFolderTpl.format((folder.selected ? 'active' : ''), folder.name, folder.access_icon, folder.id, (folder.selected ? 'checked' : '')));
                            });
                        }
                        
                        if (typeof data.access_list === 'object' && Object.keys(data.access_list).length) {
                            $.each(data.access_list, function(index, access){
                                modal.find('.btn-group-access').append(btnAccessTpl.format(access.button, (data.access === access.id ? 'active' : ''), access.trans, access.icon, access.id, (data.access === access.id ? 'checked' : '')));
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
                let file = {
                    name: modal.find('#update-file-name').val(),
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
                })
                    .done(function(data) {
                        if (typeof data.result === 'boolean' && data.result === true) {
                            $('#file-' + button.data('file-id') + ' .detail-link').text(data.name);
                            $('#file-' + button.data('file-id') + ' .td-access').attr('data-order', data.access);
                            $('#file-' + button.data('file-id') + ' .btn-access i').attr('class', 'fas fa-fw fa-' + data.access_icon);
                            $('#file-' + button.data('file-id') + ' .btn-access').attr('class', 'btn btn-sm btn-access mr-2 btn-' + data.access_button);
                            $('.data-table').DataTable().destroy();
                            initDataTable();
                            $('#update-file').modal('hide');
                        }
                    })
                    .always(function() {
                        modal.find('button.submit-form').prop('disabled', false);
                    });
            });
        });
    })(jQuery);
}
