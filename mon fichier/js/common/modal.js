const body = document.body
const redirectTo = window.location
const modal = document.getElementById('js-modal-redirection')
// Ajouter la class js-redirect sur les liens concernés
let links;

const getLinks = () => {
    links = [...document.getElementsByClassName('js-redirect')];
    links.forEach((link) => {
        link.previousOnclick = link.onclick;
        link.onclick = ((e) => {
            link.previousOnclick();
            e.preventDefault()
            showModalRedirection()
            setTimeout(() => {
                if (link.href) {
                    console.log("redirect directly to " + link.href);
                    redirectTo.href = link.href
                }
                closeModalRedirection()
            }, durationDelay)
        } )
    })
}

const durationDelay = 2000
const showModalRedirection = () => {
    body.classList.add('noscroll')
    modal.classList.add('show-modal')
}
const closeModalRedirection = () => {
    body.classList.remove('noscroll')
    modal.classList.remove('show-modal')
}

getLinks();
