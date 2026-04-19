/*when click on apparence change darkmode*/

let title = document.querySelector("#toggleMode");
let body = document.querySelector("body");

if (title) {
    title.addEventListener("click", function() {
        body.classList.toggle("darkmode");
    });
}

/*burgermenu*/

let burger = document.querySelector('#burger');
let menu = document.querySelector('#menu');

if (burger) {
    burger.addEventListener('click', function () {
        menu.classList.toggle('open');
        burger.classList.toggle('rotate');
    });
}

/*changer de carte quand tu clique dessus*/

function flipCard(card) {
    card.classList.toggle("flipped")
}

function afficherNotif() {
    const notif = document.getElementById("notif")
    notif.classList.add("visible")
    setTimeout(function () {
        notif.classList.remove("visible")
    }, 3000)
}

/*formulaire*/

let form = document.querySelector('#signupForm')
if (form) {   /*évite une erreur si on est sur une autre page et ne bloque pas le reste js*/
    form.addEventListener('submit', function(event) {
        event.preventDefault()  

        let errorContainer = document.querySelector('#errorContainer')
        let errorList = document.querySelector('#errorList')
        let successMessage = document.querySelector('#successMessage')
        errorList.innerHTML = '' 

        let pseudo = document.querySelector('#pseudo')
        if (pseudo.value.length < 6) {
            pseudo.classList.add('error')
            pseudo.classList.remove('success')
            let err = document.createElement('li')
            err.innerText = "Le pseudo doit contenir au moins 6 caractères"
            errorList.appendChild(err)
        } else {
            pseudo.classList.add('success')
            pseudo.classList.remove('error')
        }

        let email = document.querySelector('#email')
        if (email.value == '') {
            email.classList.add('error')
            email.classList.remove('success')
            let err = document.createElement('li')
            err.innerText = "L'email est obligatoire"
            errorList.appendChild(err)
        } else {
            email.classList.add('success')
            email.classList.remove('error')
        }

        /*creation du mdp -> si moins de 10 car ou ne resp pas le regex = faux*/
        let mdp = document.querySelector('#mdp')
        let passCheck = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[-+_!@#$%^&*.,?]).+$");
        if (mdp.value.length < 10 || passCheck.test(mdp.value) == false) {
            mdp.classList.add('error')
            mdp.classList.remove('success')
            let err = document.createElement('li')
            err.innerText = "Le mot de passe doit faire 10 caractères minimum, contenir une minuscule, une majuscule, un chiffre et un caractère spécial"
            errorList.appendChild(err)
        } else {
            mdp.classList.add('success')
            mdp.classList.remove('error')
        }

        /* -10 car ou ne respec par regex ou mdp diff = faux*/
        let mdpVerif = document.querySelector('#mdpVerif')
        if (mdpVerif.value.length < 10 || passCheck.test(mdpVerif.value) == false || mdpVerif.value !== mdp.value) {
            mdpVerif.classList.add('error')
            mdpVerif.classList.remove('success')
            let err = document.createElement('li')
            err.innerText = "Les mots de passe ne correspondent pas"
            errorList.appendChild(err)
        } else {
            mdpVerif.classList.add('success')
            mdpVerif.classList.remove('error')
        }

        /* afficher le resultat*/
        if (errorList.children.length > 0) {
            errorContainer.classList.add('visible')
            successMessage.classList.remove('visible')
        } else {
            errorContainer.classList.remove('visible')
            successMessage.classList.add('visible')
        }
    })
}

/*swipper*/

if (document.querySelector(".mySwiper")) {
    var swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    })
}

/*page 3 anima*/

gsap.to(".green", { 
    rotation: 360,
    duration: 1,
});
gsap.to(".purple", { 
    rotation: 360,
    duration: 1,
    delay: 1,
});
gsap.to(".orange", { 
    rotation: 360,
    duration: 1,
    delay: 2,
});
gsap.to(".yellow", { 
    rotation: 360,
    duration: 1,
    delay: 3,
});

/*page 4 galery*/ 

const glightbox = GLightbox({
  openEffect: 'zoom',
  closeEffect: 'fade',
  cssEfects: {
    fade: { in: 'fadeIn', out: 'fadeOut' },
    zoom: { in: 'zoomIn', out: 'zoomOut' }
  }
});
