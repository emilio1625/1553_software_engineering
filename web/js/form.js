/*
 * Copyright (c) 2016. ingenioWeb
 * Author(s): emilio1625
 * Last Modified: 31/12/16 03:50 PM
 *
 */
function auto_complete_field(field, listUrl, getUrl, minimum_length) {
    var options = {
        url_list: listUrl,
        url_get: getUrl,
        otherOptions: {
            minimumInputLength: minimum_length,
            theme: 'boostrap',
            formatNoMatches: 'Sin resultados...',
            formatSearching: 'Buscando...',
            formatInputTooShort: 'Escribe al menos caracteres'
        }
    };
    $(field).autocompleter(options);
}
