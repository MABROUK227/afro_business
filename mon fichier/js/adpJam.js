var cacheWhere = {};
var cacheWhat = {};
var autocompleteWhereInput = null;

function base64_decode(data) {
    var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
        ac = 0,
        dec = '',
        tmp_arr = [];

    if (!data) {
        return data;
    }

    data += '';

    do {
        h1 = b64.indexOf(data.charAt(i++));
        h2 = b64.indexOf(data.charAt(i++));
        h3 = b64.indexOf(data.charAt(i++));
        h4 = b64.indexOf(data.charAt(i++));

        bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

        o1 = bits >> 16 & 0xff;
        o2 = bits >> 8 & 0xff;
        o3 = bits & 0xff;

        if (h3 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1);
        } else if (h4 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1, o2);
        } else {
            tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
        }
    } while (i < data.length);

    dec = tmp_arr.join('');

    return dec.replace(/\0+$/, '');
}

function unjamHtmlContent(htmlId){
    var elt = document.getElementById(htmlId);
    // verify if innerHTML is a base64encoded string
    if(elt.innerHTML.lastIndexOf('=')+1==elt.innerHTML.length){
        elt.innerHTML = base64_decode(elt.innerHTML);
    }
}

function replaceClass(id, class1, class2){
    if(class1 != null && class1 != undefined && class2 != null && class2 != undefined){
        $("#"+id).removeClass(class1);
        $("#"+id).addClass(class2);
    }
}

function decodeNumberTel(blockTelId, numberDecoded, slug, typePage){
    var elt = document.getElementById(blockTelId);
    // verify if innerHTML is a base64encoded string
    if(numberDecoded.lastIndexOf('=')+1==numberDecoded.length){
        tel = base64_decode(numberDecoded);
        $(elt).addClass('is-shown');

        if ($(elt).is('a')) {
            $(elt).addClass('button-inside-click'); // Used for unit tests
            $(elt).children('span').html('<span class="screen_reader">Appeler le </span>' + tel);
            $(elt).attr('href', 'tel:'+tel.split(' ').join(''));
        } else {
            $(elt).children('a').removeClass();
            $(elt).children('a').addClass('button-inside-click'); // Used for unit tests
            $(elt).children('a').html('<span class="screen_reader">Appeler le </span>' + tel);
            $(elt).children('a').attr('href', 'tel:'+tel.split(' ').join(''));
        }

        $(elt).children('i').hide();

        elt.removeAttribute("onclick");
        elt.addEventListener('click', function(){
            atinternetClick('appeler', slug, typePage, 'BI');
            this.removeAttribute('data-pjstats');
        });
    }
    return false;
}
function decodeEmail(emailId, encodedEmail) {
    var elt = document.getElementById(emailId);
    var email = base64_decode(encodedEmail);
    $(elt).addClass('is-shown');

    if ($(elt).is('a')) {
        $(elt).addClass('button-inside-click'); // Used for unit tests
        $(elt).children('span').html('<span class="screen_reader">contacter </span>' + email);
        $(elt).attr('href', 'mailto:'+email);
    } else {
        $(elt).children('a').removeClass();
        $(elt).children('a').addClass('button-inside-click'); // Used for unit tests
        $(elt).children('a').html('<span class="screen_reader">contacter </span>' + email);
        $(elt).children('a').attr('href', 'mailto:'+email);
    }

    $(elt).children('i').hide();

    elt.removeAttribute("onclick");
    elt.addEventListener('click', function(){
        atinternetClick('appeler', slug, typePage, 'BI');
        this.removeAttribute('data-pjstats');
    });
    return false;
}

/* JIRA : PART-1178
* Fonction temporaire qui permet d'appeler via un mobile tout en générant la stats "clicAnn"
* Une meilleure solution peut-être Philippe ?
*/
function ab_test_call(elt) {
    number = elt.attributes.href.value.replace('tel:', '');
    console.debug('tel://' + number);
    window.location.href = 'tel://' + number;
    return false;
}

function searchFormSubmit(){
    let inputWhere = document.querySelector("input[name='whereText']");

    if(document.getElementById("latitude").value != "" && document.getElementById("longitude").value != ""){
        x = document.getElementById("longitude").value;
        y = document.getElementById("latitude").value;
        inputWhere.removeAttribute("required");
        document.getElementById("queryWhere").setAttribute("value", 'cZ'+x+','+y);
    }else{
        document.getElementById("queryWhere").setAttribute("required", "required");
        textWhere = inputWhere.value;
        if(textWhere != ""){
            document.getElementById("queryWhere").setAttribute("value", textWhere);
        }
    }
}


function showPosition(e) {

    let searchForm = Array.from(document.querySelectorAll(".search-form"));
    let latitude = document.getElementById("latitude");
    let longitude = document.getElementById("longitude");
    autocompleteWhereInput = $("#input_Where");
    const keyCode = e.keyCode || e.which;
    if(e.type == "click" || e.type == "keypress" && keyCode == 13) {
        if( latitude.value == "" && longitude.value == ""){
            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                        
                    replaceClass("geoLocationIcon" ,"adp-icon--fleche-gps", "adp-icon--located")
                    /*
                    searchForm.forEach((el) => {
                        el.classList.add("LoadGeoloc");
                        if(el.classList.contains("LoadGeoloc") ) {
                            [...el.querySelectorAll("input"), el.querySelector("button")]
                            .forEach( element => {
                                element.disabled = true;
                            });
                        }
                    })
                    */
                    
                    latitude.value = position.coords.latitude;
                    longitude.value = position.coords.longitude;
                    
                    var positionInfo = "La position GPS est (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
                    console.debug(positionInfo);

                    $.ajax({
                        url:'/ajax/address?lat='+position.coords.latitude+'&long='+position.coords.longitude,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            if (data.address) {
                                autocompleteWhereInput.val(data.address);
                                /*
                                searchForm.forEach((el) => {
                                    // el.classList.remove("LoadGeoloc");
                                    [...el.querySelectorAll("input"), el.querySelector("button")]
                                    .forEach( element => {
                                        element.disabled = false;
                                    });
                                })
                                */

                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    })
                });
            } else {
                alert("Nous ne pouvons pas récupérer la position GPS / geolocation.");
            }   
        } else {
            replaceClass("geoLocationIcon" ,"adp-icon--located", "adp-icon--fleche-gps")
            latitude.value = "";
            longitude.value = "";
            autocompleteWhereInput.val("");
        }
    }
}

const geoloc = document.querySelector('#geolocActive');
if (geoloc) {
    geoloc.addEventListener('click', (e) => showPosition(e));
    geoloc.addEventListener('keypress', (e) => showPosition(e));
}


function striptags(html)
{
    const tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return(tmp.textContent || tmp.innerText || "");
}


/**
 * lien brouillé
 */
function adpJamLink()
{
    $(document).on('click keypress','.adpJam', function(e) {
        const keyCode = e.keyCode || e.which;
        let adpJam_target = null;
        let adpJam_isExternal = false;
        let adpJam_noPJ = false;
        let adpJam_targetPrefix = 'adpJam_tgt_';
        let classList = $(this).attr('class').split(/\s+/);
        let adpJam_isInMapResult = false;
        if(e.type === "click" || e.type === "keypress" && keyCode === 13) {
            $.each( classList, function(index, item){
                // get target url
                if(item.indexOf(adpJam_targetPrefix) === 0) { adpJam_target = item.substr(adpJam_targetPrefix.length); }
                // get isExternal (to open in new page)
                else if(item === 'adpJam_isXtn'){ adpJam_isExternal = true; }
                // detect if we are in a map popin
                if (item === "adp-map-result-overlay") { adpJam_isInMapResult = true; }
                // detect if not a pj target link
                if (item === 'adpJam_noPJ') { adpJam_noPJ = true; }
            });
            if (adpJam_target !== null) {
                let adpJam_durationDelay = 0;
                let clearUrl = base64_decode(adpJam_target);
                if (!adpJam_noPJ && (clearUrl.indexOf('www.pagesjaunes.fr') >= 0 ||
                    clearUrl.indexOf('stat.pagesjaunes.fr') >= 0 ||
                    clearUrl.indexOf('ciwstattest.pagesjaunes.fr') >= 0)) {
                    adpJam_durationDelay = durationDelay;
                    showModalRedirection();
                }
                setTimeout(() => {
                    window.location = clearUrl;
                    closeModalRedirection();
                }, adpJam_durationDelay);
            }
            if (adpJam_isInMapResult) {
                atinternetClick('Pin_RS', AtInternetDirSlug, AtInternetTypePageDirectory, 'Carte');
            }
        }
    })
}

/*
 * This action enables jammed lnks for css class "adpJam"
 */
$(document).ready(function() {
    adpJamLink();
});
