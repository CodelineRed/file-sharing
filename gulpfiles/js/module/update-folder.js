/*global initDataTable*/
'use strict';

/**
 * Init update folder modal
 * 
 * @returns {undefined}
 */
function initUpdateFolder() {
    (function($) {
        // 1: button class, 2: active class, 3: label, 4: access icon, 5: value, 6: checked attribute
        let btnAccessTpl = '<label class="btn btn-%s btn-sm mr-2 mb-2 %s">%s <i class="fas fa-fw fa-check"></i><i class="fas fa-fw fa-times"></i> <i class="fas fa-%s"></i><input value="%s" type="radio" class="update-folder-access" name="update_folder_access" %s/></label>';
        
        $('#update-folder').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let modal = $(this);
            
            modal.find('.modal-footer button.submit-form').prop('disabled', true);
            modal.find('#update-folder-name').val('');
            
            $.ajax({
                url: button.data('get-folder'),
                method: 'get',
                dataType: 'json'
            })
                .done(function(data) {
                    if (typeof data.result === 'boolean' && data.result === true) {
                        modal.find('button.submit-form').prop('disabled', false);
                        modal.find('#update-folder-name').val(data.name);
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
                })
                    .done(function(data) {
                        if (typeof data.result === 'boolean' && data.result === true) {
                            $('#folder-' + button.data('folder-id') + ' .detail-link').text(data.name);
                            $('#folder-' + button.data('folder-id') + ' .td-access').attr('data-order', data.access);
                            $('#folder-' + button.data('folder-id') + ' .btn-access i').attr('class', 'fas fa-fw fa-' + data.access_icon);
                            $('#folder-' + button.data('folder-id') + ' .btn-access').attr('class', 'btn btn-sm btn-access mr-2 btn-' + data.access_button);
                            $('.data-table').DataTable().destroy();
                            initDataTable();
                            $('#update-folder').modal('hide');
                        }
                    })
                    .always(function() {
                        modal.find('button.submit-form').prop('disabled', false);
                    });
            });
        });
    })(jQuery);
}
