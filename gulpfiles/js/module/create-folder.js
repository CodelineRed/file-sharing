'use strict';

/**
 * Init edit folder modal
 * 
 * @returns {undefined}
 */
function initCreateFolder() {
    (function($) {
        // 1: button class, 2: active class, 3: label, 4: access icon, 5: value, 6: checked attribute
        var btnAccessTpl = '<label class="btn btn-%s btn-sm mr-2 mb-2 %s">%s <i class="fas fa-fw fa-check"></i><i class="fas fa-fw fa-times"></i> <i class="fas fa-%s"></i><input value="%s" type="radio" class="create-folder-access" name="create_folder_access" %s/></label>';
        
        $('#create-folder').on('show.bs.modal', function(event) {
            $('#update-file').modal('hide');
            var button = $(event.relatedTarget);
            var modal = $(this);
            var fileId = button.data('file-id');
            
            modal.find('.modal-footer button.submit-form').prop('disabled', true);
            modal.find('#create-folder-name').val('');
            
            $.ajax({
                url: button.data('get-access-list'),
                method: 'get',
                dataType: 'json'
            })
                .done(function(data) {
                    if (typeof data.result === 'boolean' && data.result === true) {
                        modal.find('button.submit-form').prop('disabled', false);
                        modal.find('.btn-group-access > .btn').remove();
                        
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
                var folder = {
                    name: modal.find('#create-folder-name').val(),
                    access: modal.find('input.create-folder-access:checked').val()
                };
                
                modal.find('button.submit-form').prop('disabled', true);
                
                $.ajax({
                    url: button.data('create-folder'),
                    method: 'post',
                    dataType: 'json',
                    data: folder
                })
                    .done(function(data) {
                        if (typeof data.result === 'boolean' && data.result === true) {
                            $('#create-folder').modal('hide');
                            
                            // fileId exists, reopen #update-file
                            if (typeof fileId === 'string' && fileId.length) {
                                $('#file-' + fileId + ' .btn-update-file').click();
                            } else {
                                window.location.hash = 'folderTableTab';
                                window.location.reload();
                            }
                        }
                    })
                    .always(function() {
                        modal.find('button.submit-form').prop('disabled', false);
                    });
            });
        });
    })(jQuery);
}
