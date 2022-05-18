'use strict';

function getParameters()
{
    var url    = window.location.search.substring(1);
    var varUrl = url.split('&');
    var parameter = {};

    $.each(varUrl, function(k,v){
        let item = v.split('=');
        parameter[item[0]] = item[1];
    });

    return parameter;
}

function setParameters(parameters)
{
    if (Object.keys(parameters).length == 0)
        return '/';

    var urlParams   = '?';

    $.each(parameters, function(k,v){
        if (k !== '')
            urlParams = urlParams + k + '=' + v + '&';
    });

    return urlParams.slice(0, -1);
}

function addParameter(parameters, item)
{
    if (item[1] != "")
        parameters[item[0]] = item[1];
    else 
        delete parameters[item[0]];

    return parameters;
};

function setSpinner(target)
{
    var container = $('<div/>').addClass('position-absolute w-100 h-100 top-0 start-0 bg-white').hide().appendTo(target).fadeIn('fast');
    var spinner = $('<div/>').addClass('sk-circle').appendTo(container);
    
    for (let i = 1; i <= 12; i++) {
        $('<div/>').addClass('sk-circle'+i+' sk-child').appendTo(spinner);
    }

    return container;
}
