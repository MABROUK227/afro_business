const header = document.querySelector('.main-header');
const burger = document.querySelector('.menu-burger');
const dropdown = Array.from(document.querySelectorAll('.dropdown'));
const sub_dropdown = Array.from(document.querySelectorAll('.sub-dropdown'));
const account = document.querySelector('.account');
const account_menu = document.querySelector('#menu-account');

// Close dropdown & burger menu when click outside pop
header.addEventListener('click', (e) => {
    if(e.target.classList.contains('adpJam')) return;
    e.stopPropagation();
})

/**
 * Passe l'attr. aria-expanded du tableau des éléments à false
 * @param {Array} args
 */
const expandedToFalse = (args) => {
    args.forEach((el) => {
        el.setAttribute('aria-expanded', false);
    })
}

document.addEventListener('click', (e) => {
    const isOpen = Array.from(header.querySelectorAll('[aria-expanded="true"]'));
    if(isOpen) {
        expandedToFalse(isOpen);
    }
})

/**
 * Gestion du switch des dropdown du header
 */
const switchDropdown = (e) => {
    const keyCode = e.keyCode || e.which;
    if(e.type == "click" || e.type == "keypress" && keyCode == 13) {
        if(e.target === dropdown[0] && dropdown[1].getAttribute('aria-expanded')) {
            dropdown[1].setAttribute('aria-expanded', false);
        } 
        if(e.target === dropdown[1] && dropdown[0].getAttribute('aria-expanded')) {
            dropdown[0].setAttribute('aria-expanded', false);
        }
    }
}
dropdown.forEach((el) => {
    el.addEventListener('click', switchDropdown)
    el.addEventListener('keypress', switchDropdown)
});

/**
 * Gestion du switch des sub-dropdown du header (réunir les 2 en une seul fonction ?)
 */
const switchSubDropdown = (e) => {
    const keyCode = e.keyCode || e.which;
    if(e.type == "click" || e.type == "keypress" && keyCode == 13) {
        if(!e.target.hasAttribute('aria-expanded')) return;
        const others_subDropDown = sub_dropdown.slice();
        const index = others_subDropDown.indexOf(e.target);
        if(index > -1) others_subDropDown.splice(index, 1);
        expandedToFalse(others_subDropDown);
    }
}

sub_dropdown.forEach((el) => {
    el.addEventListener('click', switchSubDropdown)
    el.addEventListener('keypress', switchSubDropdown)
});