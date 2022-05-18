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