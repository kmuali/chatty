function Quesrtions(x) {
    let qu = [
        "What is the longest river in the world ..?",
        "What is the shortest river in the world ..? ",
        "What is the largest planet in the solar system ..?",
        "What is the smallest planet in the solar system ..?",
        "What are the largest continents in the world ..?",
        "What are the smallest continents in the world ..?"
    ];

    return qu[x];
}

function Ans(x) {
    let ans = [
        ["The Nile River.", "Amazon River", "Tagus river", "Maranon River"],
        ["The Nile River", "Amazon River", "Tagus river", "Roe River."],
        ["Planet Earth", "Mercury", "Jupiter.", "Venus"],
        ["Planet Earth", "Mercury.", "Jupiter", "Venus"],
        ["Asia.", "Africa", "Australia", "Europe"],
        ["Asia", "Africa", "Australia.", "Europe"]
    ];

    return ans[x];
}

function play(x) {
    let q = Quesrtions(x);
    let a = Ans(x); 
    let correct = "Test";

    for (let i = 0; i < a.length; i++)
        if (a[i].endsWith(".")) {
            correct = a[i];
            correct = correct.slice(0, -1);
            a[i] = correct;
        }
    
    question.innerHTML = q;
    b1.innerHTML = a[0];
    b2.innerHTML = a[1];
    b3.innerHTML = a[2];
    b4.innerHTML = a[3];
    
    b1.style.borderWidth = "0";
    b2.style.borderWidth = "0";
    b3.style.borderWidth = "0";
    b4.style.borderWidth = "0";

    if (b1.innerHTML === correct) {
        b1.style.borderColor = "green";
        b2.style.borderColor = "red";
        b3.style.borderColor = "red";
        b4.style.borderColor = "red";
    }
    else if (b2.innerHTML === correct) {
        b2.style.borderColor = "green";
        b1.style.borderColor = "red";
        b3.style.borderColor = "red";
        b4.style.borderColor = "red";
    }
    else if (b3.innerHTML === correct) {
        b3.style.borderColor = "green";
        b1.style.borderColor = "red";
        b2.style.borderColor = "red";
        b4.style.borderColor = "red";
    }
    else{
        b4.style.borderColor = "green";
        b1.style.borderColor = "red";
        b2.style.borderColor = "red";
        b3.style.borderColor = "red";
    }
    
    b1.onclick = function () {
    b1.style.borderWidth = "10px";
    b2.style.borderWidth = "10px";
    b3.style.borderWidth = "10px";
    b4.style.borderWidth = "10px";
    if (b1.innerHTML === correct)
        score++;
    }
    
    b2.onclick = function () {
    b1.style.borderWidth = "10px";
    b2.style.borderWidth = "10px";
    b3.style.borderWidth = "10px";
    b4.style.borderWidth = "10px";
    if (b2.innerHTML === correct)
        score++;
    }
    
    b3.onclick = function () {
    b1.style.borderWidth = "10px";
    b2.style.borderWidth = "10px";
    b3.style.borderWidth = "10px";
    b4.style.borderWidth = "10px";
    if (b3.innerHTML === correct)
        score++;
    }
    
    b4.onclick = function () {
    b1.style.borderWidth = "10px";
    b2.style.borderWidth = "10px";
    b3.style.borderWidth = "10px";
    b4.style.borderWidth = "10px";
    if (b4.innerHTML === correct)
        score++;
    }
    console.log(`score: ${score}`);

    // counter++;
}

function generateUniqueRandom(maxNr) {
    //Generate random number
    let random = (Math.random() * maxNr).toFixed();

    //Coerce to number by boxing
    random = Number(random);

    if(!r.includes(random)) {
        r.push(random);
        return random;
    }
    else {
        if(r.length < maxNr) 
          //Recursively generate number
            return  generateUniqueRandom(maxNr);
        else 
            return false;
        
    }
}

let question = document.getElementById("q");
let b1 = document.getElementById("ans1");
let b2 = document.getElementById("ans2");
let b3 = document.getElementById("ans3");
let b4 = document.getElementById("ans4");
let next = document.getElementById("next");

let score = 0;
let counter = 1;
let size = 3;
let r = [];

generateUniqueRandom(5);
generateUniqueRandom(5);
generateUniqueRandom(5);

play(r[0]);
counter++;

next.onclick = function () {   
    if (counter === 2) {
        play(r[1]);
        counter++;
    }

    else if (counter === 3) {
        play(r[2]);
        counter++;
    }

    else if (counter === 4)
        alert(`Your Score = ${score} / 3`);
}
