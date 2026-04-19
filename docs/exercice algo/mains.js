 /**exercice 1*/

for ( let i = 0; i <=10; i++) {
    console.log("7 x "+ i +"="+ i*7)
}

/**exercice 2*/

let note = 15;

switch (true) {
    case 20 :
    case 19 :
    case 18 :
        console.log("Excellent")
        break;

    case 17 :
    case 16 :
    case 15 :
    case 14 :
        console.log("Bien")
        break;

    case 13 :
    case 12 :
    case 11 :
    case 10 :
        console.log("Passable")
        break;
    
        default:
            console.log("Insuffisant")
            break;
}

/**exercice 3*/

function calculerPrix(prixHT, tva) {
    let prix = prixHT + prixHT * tva / 100;
    return Math.round(prix * 100) / 100;
}

let prixBouteille = calculerPrix(2.2, 20);
console.log(prixBouteille);


/**exercice 4*/

let prenom = "Alex";
let notes = [12, 15, 10, 18, 14, 9, 16, 13];

function calculerMoyenne(notes){
    resultat = 0
    for(let i = 0; i < notes.length; i++){
        resultat += notes[i];
    }
    resultat /= notes.lenght;
    return parseFloat(resultat.toFixed(1));
}

console.log(calculerMoyenne(notes)); 