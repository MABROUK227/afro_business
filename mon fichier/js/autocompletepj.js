function registerAutocompleteWhatCodex(){
    let inputWhat = document.querySelector("input[name='queryWhat']")
    if ($(inputWhat).length>0)
    {
		zewhatterm = null;
        $(inputWhat).autocomplete({
            minLength: 2,
            appendTo: "#what_autoComplete",
            delay: 100,
            messages: {
                noResults: '',
                results: function () {
                }
            },
            source: function (request, response) {
                zewhatterm = request.term;
                //Si la réponse est dans le cache
                if (request.term in cacheWhat && cacheWhat == null) {
                    response($.map(cacheWhat[request.term], function (item) {
                        return ({
                            label: item.label.value,
                            value: function () {
                                return (item.label.value);
                            }
                        });
                    }));
                }
                //Sinon -> Requete Ajax
                else {
                    var url = $(this.element).attr('data-url');
                    var objData = {search: request.term};
                    $.ajax({
                        url: url,
                        dataType: "json",
                        data: { "search" : request.term},
                        type: 'GET',
                        success: function (data) {
                            cacheWhat[request.term] = data;

                            response($.map(data.hits, function (item) {
                                return ({
                                    label: item.label.value,
                                    // slug: item['slug'],
                                    value: function () {
                                        return (item.label.value);
                                    }
                                });
                            }));
                        },
                        error: function ( jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR, textStatus, errorThrown);
                        }
                    });
                }
            },
            close: function(event, ui) {
            },
            select: function( event, ui ) {
                $(inputWhat).val(ui.item.label);
                $('#what_type').val($("#what_label").attr('data-geo'));
                $('#PjSearchForm_whatSlug').val(ui.item.slug);
                $("#PjSearchForm").submit();
                return(false);
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			str = item.label.replace(eval("/("+zewhatterm+")/i"), '<strong class="searchedterm">$1</strong>' );
            return($( "<li>" ).append( "<a>" + str + "</a>" ).appendTo( ul ));
        };
    }
}

function registerAutocompleteWhereCodex()
{
	zewhereterm = null;
    let inputWhere = $("#input_Where");
    if (inputWhere.length>0)
    {
        inputWhere.autocomplete({
            minLength: 2,
            appendTo: "#where_autoComplete",
            delay: 200,
            messages: {
                noResults: '',
                results: function() {}
            },
            source: function (request, response)
            {
				zewhereterm = request.term;
                //Si la réponse est dans le cache
                if (request.term in cacheWhere){
                    response($.map(cacheWhere[request.term], function (item){
                        return ({
                            label: item.label.value,
                            value: function (){return item.label.value;}
                        });
                    }));
                }
                //Sinon -> Requete Ajax
                else
                {
                    var url = $(this.element).attr('data-url');
                    var objData = { search: request.term };

                    $.ajax({
                        url: url,
                        dataType: "json",
                        data : objData,
                        type: 'GET',
                        success: function (data)
                        {
                            //Ajout de reponse dans le cache
                            cacheWhere[request.term] = data.hits;

                            response($.map(data.hits, function (item)
                            {
                                return ({
                                    label: item.label.value,
                                    value: function ()
                                    {
                                        return item.label.value;
                                    }
                                });
                            }));
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
            },
            close: function(event, ui) {
            },
            select: function( event, ui ) {
                inputWhere.val(striptags(ui.item.label));
                $('#where_autoComplete').val(striptags(ui.item.label));
                return(false);
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			str = item.label.replace(eval("/("+zewhereterm+")/i"), '<strong class="searchedterm">$1</strong>' );
            return($( "<li>" ).append( "<a>" + str + "</a>" ).appendTo( ul ));
        };
    }
}

