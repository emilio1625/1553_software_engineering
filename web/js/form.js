/*
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 31/12/16 03:50 PM
 *
 */
/* form modal to insert a new Author (you need this onlu for the "add new" feature. See README) */
function modalForm(prefix, entity) {
    /** prefix is the entity to which belong the form */
    /** entity type for the form to be created so we can have several 'new' options */
    var modalformentity = '.modal' + '.' + entity + ' form .';
    $('body').on('submit', modalformentity, function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var data = $(this).serialize();
        var $modal = $(this).parents('.modal');
        $modal.on('hidden.bs.modal', function () {
            $(this).data('bs.modal', null);
        });
        $.ajax({
            url: url,
            method: method,
            data: data
        }).done(function (res) {    // res can be a JSON object or an HTML string
            if (typeof res === 'object') {
                // if it'a a JSON, form is valid
                $modal.modal('hide');
                var $input = $('#' + prefix + '_form_' + res.type);
                $input.val(res.id).trigger('change');
                // this workaround is needed because we can't set a val() to a non-existant option

                $('.select2-chosen').each(function () {
                    if ($(this).parents('div').attr('id').indexOf(prefix + '_form_' + res.type) > -1) {
                        $(this).text(res.name);
                    }
                });
            } else {
                // if is HTML, form is invalid (has errors)
                $modal.modal('hide');
                $(res).modal();
            }
        });
    });
};

function autocomplete_field(prefix, entity, listUrl, getUrl, minimum_length) {
    var options = {
        url_list: listUrl,
        url_get: getUrl,
        otherOptions: {
            minimumInputLength: minimum_length,
            theme: 'boostrap',
            formatNoMatches: 'Sin resultados...',
            formatSearching: 'Buscando...',
            formatInputTooShort: 'Escribe al menos ' + minimum_length + ' caracteres'
        }
    };
    var fieldtocomplete = "#" + prefix + "_form_" + entity;
    console.log(fieldtocomplete);
    $(fieldtocomplete).autocompleter(options);
}

function autocomplete_or_new_field(prefix, entity, listUrl, getUrl, minimum_length) {
    autocomplete_field(prefix, entity, listUrl, getUrl, minimum_length);
    modalForm(prefix, entity);
    newlink = "#url-new-" + entity;
    var $addNew = $('<a>').text('Nuevo').attr('class', 'btn btn-xs btn-success ajax-modal').attr('href', $(newlink).attr('href'));
    $('label[for=' + prefix + "_form_" + entity + ']').after($addNew).after(' ');

}

$(document).ready(function () {
    /* ajax modal (you need this only for the "add new" feature. See README) */
    $('body').on('click', 'a.ajax-modal', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url, function (data) {
            $(data).modal();
        });
    });
});



