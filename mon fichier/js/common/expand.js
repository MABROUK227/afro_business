const toggleExpand = (e) => {
    e.stopPropagation();
    const keyCode = e.keyCode || e.which;
    if(e.type == "click" || e.type == "keypress" && keyCode == 13) {
        if(!e.target.hasAttribute('aria-expanded')) return;
        e.target.getAttribute('aria-expanded') === 'false' ?
            e.target.setAttribute('aria-expanded', true) : e.target.setAttribute('aria-expanded', false);
    }
    return;
}

/**
 * 
 * Récupère tous les éléments qui possèdent l'attribut "aria-expanded" et ajoute les events click et keypress
 */

const getExpandElement_addEvent = () => {
    const expand_el = Array.from(document.querySelectorAll('[aria-expanded]'))
    expand_el.forEach(el => {
        el.addEventListener('click', toggleExpand)
        el.addEventListener('keypress', toggleExpand)
    });
}

getExpandElement_addEvent();

 
