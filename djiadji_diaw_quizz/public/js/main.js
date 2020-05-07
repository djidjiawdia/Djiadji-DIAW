/************************ INDEX FORM VALIDATION ************************/
const indexFormEl = document.getElementById("indexForm");

if(indexFormEl != null){
    
    indexFormEl.addEventListener("change", e => formInputRemoveErr(e));
    
    indexFormEl.addEventListener("submit", e => {
        e.preventDefault();
        if(formInputValid(e)){
            indexFormEl.submit();
        }
    });
}

/************************ FORM FUNCTION VALIDATION ************************/
const regexLogin = /^[A-Za-z]\w{5,}$/;
const regexPass = /^(?=.*[A-Z])(?=.*[\w])(?=.*[0-9])(?=.*[a-z]).{6,14}$/;
formInputRemoveErr = (e) => {
    if(e.target.type == 'file'){
        const fileSize = e.target.files[0].size;
        const fileName = e.target.files[0].name;
        
        const extensions = ["jpg", "jpeg", "png"];

        const fileExt = fileName.split(".");
        fileActExt = fileExt[fileExt.length-1].toLowerCase();

        const avatar = document.getElementById('inscAvatar');
        
        if(e.target.value !== '' && fileSize <= 500000 && extensions.includes(fileActExt)){
            if(e.target.parentElement.querySelector('p') != null){
                e.target.parentElement.removeChild(e.target.parentElement.querySelector('p'))
            }
            avatar.src = URL.createObjectURL(e.target.files[0]);
        }else{
            avatar.src = "./public/images/avatar.png";
        }
    }else if(e.target.value.trim() !== ""){
        if(e.target.parentElement.querySelector('p') != null){
            e.target.parentElement.removeChild(e.target.parentElement.querySelector('p'))
        }
    }
}

formInputValid = (e) => {
    formValid = true
    const formEl = e.target.querySelectorAll("input");
    formEl.forEach(el => {
        if(el.parentElement.querySelector('p') != null){
            el.parentElement.removeChild(el.parentElement.querySelector('p'))
        }
        const p = document.createElement('p');
        p.style.color = "red";
        if(el.type === 'file'){
            if(el.value === ''){
                p.innerHTML = "Veuillez choisir une image";
                el.parentElement.append(p);
                formValid = false;
                // el.parentElement.children[1].classList.add("bg-error");
            }else{
                const fileSize = el.files[0].size;
                const fileName = el.files[0].name;
                
                const extensions = ["jpg", "jpeg", "png"];

                const fileExt = fileName.split(".");
                fileActExt = fileExt[fileExt.length-1].toLowerCase();

                if(!extensions.includes(fileActExt)){
                    p.innerHTML = "Veuillez choisir un format jpg ou png";
                    el.parentElement.append(p);
                    formValid = false;
                }else if(fileSize > 500000){
                    p.innerHTML = "Fichier trop volumineux";
                    el.parentElement.append(p);
                    formValid = false;
                }
            }
        }else if(el.value.trim() == ''){
            p.innerHTML = `${(el.parentElement.children[0].innerText)?el.parentElement.children[0].innerText : el.attributes.placeholder.value} ne doit pas être vide`;
            el.parentElement.append(p);
            formValid = false;
        }else if(el.name === 'login'){
            if(el.value.match(regexLogin) == null){
                p.innerHTML = "Login invalid: Entrer des lettres et des chiffres > 5";
                el.parentElement.append(p);
                formValid = false;
            }
        }else if(el.type === 'password'){
            if(el.name === 'password'){
                if(el.value.match(regexPass) == null){
                    p.innerHTML = "Le mot de passe doit avoir des caractères majuscules et minuscules et des chiffres. max: 14 caractères";
                    el.parentElement.append(p);
                    formValid = false;
                }
            }else{
                formEl.forEach(pass => {
                    if(pass.type === 'password'){
                        if(pass.name === 'password'){
                            if(el.value !== pass.value){
                                p.innerHTML = "Les mots de passe ne sont pas identique";
                                el.parentElement.append(p);
                                formValid = false;
                            }
                        }
                    }
                });
            }
        }
    });
    return formValid;
}


/************************ MENU ADMIN PAGE ************************/
const liEl = document.querySelectorAll('.menu > li');
const regexLink = /index\.php\?page=accueil$/;

if(liEl != null){
    if(location.href.match(regexLink) != null){
        liEl[0].className = 'active';
        liEl[0].children[1].src = liEl[0].children[1].src.replace(".png", "-active.png");
    }else{
        liEl.forEach(el => {
            el.className = '';
            el.children[1].src = el.children[1].src.replace("-active", "");
            if(el.children[0].href === location.href){
                el.className = "active";
                el.children[1].src = el.children[1].src.replace(".png", "-active.png");
            }
        })
    }
}

/************************ DECONNEXION ************************/
const decon = document.getElementById('deconnexion');
if(decon != null){
    decon.addEventListener("click", e => {
        if(!confirm('Voulez vous se deconnecter ?')){
            e.preventDefault();
        }
    });
}


/************************ INSCRIPTION FORM VALIDATION ************************/
const inscFormEl = document.getElementById("inscForm");

if(inscFormEl != null){
    
    inscFormEl.addEventListener("change", e => formInputRemoveErr(e));
    
    inscFormEl.addEventListener("submit", e => {
        e.preventDefault();
        if(formInputValid(e)){
            inscFormEl.submit();
        }
    });
}

/************************ LISTE JOUEURS PAGINATION ************************/
const tabEl = document.getElementById("listeJ");
const btnPrev = document.getElementById("prev");
const btnNext = document.getElementById("next");
if(tabEl != null){
    const nbrParPage = 15;
    let currentPage = 1;
    
    const rows = (tabEl.getElementsByTagName("tbody"))[0].rows;
    const nbrVal = rows.length;
    const nbrPage = Math.ceil(nbrVal / nbrParPage);
    
    showCurrent = (current) => {
        hidePagi(rows);
        for(i=(current-1)*nbrParPage; i<current*nbrParPage; i++){
            if(i === rows.length){
                break;
            }else{
                rows[i].style.display = "";
            }
        }
        if(current <= 1){
            btnPrev.style.display = "none";
        }else{
            btnPrev.style.display = "";
        }
        if(current >= nbrPage){
            btnNext.style.display = "none";
        }else{
            btnNext.style.display = "";
        }
    }
    
    btnNext.addEventListener('click', () => {
        currentPage++;
        showCurrent(currentPage);
    })
    
    btnPrev.addEventListener('click', () => {
        currentPage--;
        showCurrent(currentPage);
    })
    
    
    hidePagi = (tabs) =>{
        for(i=0; i<tabs.length; i++){
            tabs[i].style.display = "none";
        }
    }
    
    showCurrent(currentPage);
}

/************************ QUESTION FORM VALIDATION ************************/
const questForm = document.getElementById('questForm')

if(questForm != null){
    const addInput = questForm.querySelector('#addInput');
    const respContent = document.getElementById('resp');
    const typeRep = questForm.querySelector('#typeRep');
    
    ajouterInput = () => {
        const numRep = respContent.children.length+1;
        if(numRep < 5){
            addInput.style.display = 'flex';
            const div1 = document.createElement('div');
            div1.setAttribute('class', 'form-group-q row');
            
            const divLabel = document.createElement('div');
            divLabel.setAttribute('class', 'col-sm');
            const label = document.createElement('label');
            label.setAttribute('for', `reponse${numRep}`);
            label.innerHTML = `Reponse ${numRep}`
            divLabel.append(label);
            
            const divInput = document.createElement('div');
            divInput.setAttribute('class', 'col-md input-group');
            const input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('class', 'rep-input bg-input');
            input.setAttribute('id', `reponse${numRep}`);
            input.setAttribute('name', 'reponse[]');
            const divC = document.createElement('div');
            divC.setAttribute('class', 'typeChoix');
            if(typeRep.value !== 'texte'){
                const inputC = document.createElement('input');
                if(typeRep.value === "checkbox"){
                    inputC.setAttribute('type', 'checkbox');
                }
                
                if(typeRep.value === "radio"){
                    inputC.setAttribute('type', 'radio');
                }
                
                inputC.setAttribute('name', 'repC[]');
                inputC.setAttribute('value', numRep-1);
                divC.append(inputC);
                
                const img = document.createElement('img');
                img.setAttribute('src', './public/icones/ic-supprimer.png');
                divC.append(img);
            }
            divInput.append(input);
            
            divInput.append(divC);
            
            div1.append(divLabel);
            div1.append(divInput);
            respContent.append(div1);
        }else{
            addInput.style.display = "none";
        }
    }
    
    addInput.addEventListener('click', () => {
        ajouterInput();
        if(respContent.children.length > 1){
            if(questForm.querySelector('p')){
                questForm.removeChild(questForm.querySelector('p'));
            }
        };
    });
    
    typeRep.addEventListener('change', e => {
        respContent.innerHTML = "";
        addInput.style.display = "";
        ajouterInput();
        if(e.target.value === 'radio'){
            const el = respContent.querySelectorAll('input[type="checkbox"]');
            el.forEach(x => {
                x.parentNode.removeChild(x);
            });
        }else if(e.target.value === 'checkbox'){
            const el = respContent.querySelectorAll('input[type="radio"]');
            el.forEach(x => {
                x.parentNode.removeChild(x);
            });
        }else if(e.target.value === 'texte'){
            const el = respContent.querySelectorAll('.typeChoix');
            el.forEach(x => {
                x.parentNode.removeChild(x);
            });
            addInput.style.display = "none";
        }
    })
    questForm.addEventListener('click', () => {
        const suppEl = questForm.querySelectorAll('img');
        suppEl.forEach(el => {
            el.addEventListener('click', () => {
                const elt = el.parentElement.parentElement.parentElement;
                elt.parentElement.removeChild(elt);
                const n = respContent.children.length;
                respContent.innerHTML = '';
                for(i=0; i<n; i++){
                    ajouterInput();
                }
                if(respContent.children.length < 2){
                    if(questForm.querySelector('p')){
                        questForm.removeChild(questForm.querySelector('p'));
                    }
                    const p = document.createElement('p');
                    p.style.color = 'red';
                    p.innerHTML = 'nbr input insuffisant';
                    questForm.prepend(p);
                };
            })
        })
    })
    
    questForm.addEventListener('change', e => {
        const selectEl = questForm.querySelectorAll(`input[type="${typeRep.value}"]:checked`);
        if(e.target.value !== ''){
            e.target.style.borderRight = '';
        }
        if(typeRep.value === 'radio'){
            if(selectEl.length > 0){
                if(questForm.querySelector('p')){
                    questForm.removeChild(questForm.querySelector('p'));
                }
            }
        }else if(typeRep.value === 'checkbox'){
                if(selectEl.length > 1){
                    if(questForm.querySelector('p')){
                        questForm.removeChild(questForm.querySelector('p'));
                    }
                }
            }
        })
        
        questForm.addEventListener('submit', e => {
            e.preventDefault();
            if(questForm.querySelector('p')){
            questForm.removeChild(questForm.querySelector('p'));
        }
        let validQuest = true;
        const n = respContent.children.length;
        const inputEl = e.target.querySelectorAll('input');
        const textArea = e.target.querySelector('textarea');
        const selectEl = e.target.querySelectorAll(`input[type="${typeRep.value}"]:checked`);
        
        if(textArea.value == ''){
            textArea.style.borderRight = "1px solid red";
            validQuest = false;
        }
        if(typeRep.value === ''){
            typeRep.style.borderRight = "1px solid red";
            validQuest = false;
        }else if(typeRep.value === 'radio' || typeRep.value === 'checkbox'){
            if(n < 2){
                const p = document.createElement('p');
                p.style.color = 'red';
                p.innerHTML = 'nbr input insuffisant';
                questForm.prepend(p);
                validQuest = false;
            }else if(typeRep.value === 'radio' && selectEl.length < 1){
                const p = document.createElement('p');
                p.style.color = 'red';
                p.innerHTML = 'Veuillez cocher une réponse';
                questForm.prepend(p);
                validQuest = false;
            }else if(typeRep.value === 'checkbox' && selectEl.length < 2){
                const p = document.createElement('p');
                p.style.color = 'red';
                p.innerHTML = 'Veuillez cocher au moins 2 réponses';
                questForm.prepend(p);
                validQuest = false;
            }
        }
        inputEl.forEach(el => {
            if(el.value === ''){
                el.style.borderRight = "1px solid red";
                validQuest = false;
            }else if(el.type === 'number' && el.value <= 0){
                el.style.borderRight = "1px solid red";
                validQuest = false;
            }
        })
        
        if(validQuest){
            questForm.submit();
        }
        
    })
}

/************************ NOMBRE QUESTION FORM VALIDATION ************************/
const nbrQuestForm = document.getElementById('nbrQuestForm');

if(nbrQuestForm != null){
    const inputNbr = nbrQuestForm.querySelector('input');
    
    nbrQuestForm.addEventListener('change', () => {
        if(inputNbr.value != '' && inputNbr.value >= 5){
            inputNbr.style.border = "";
        }
    })
    
    nbrQuestForm.addEventListener('submit', e => {
        if(inputNbr.value === '' || inputNbr.value < 5){
            e.preventDefault();
            inputNbr.style.border = "1px solid red";
        }
    })

}

/************************ LISTE QUESTIONS PAGINATION ************************/
const listeQ = document.getElementById('listeQ');
hidePagi = (tabs) =>{
    for(i=0; i<tabs.length; i++){
        tabs[i].style.display = "none";
    }
}

if(listeQ != null){
    const nbrParPage = nbrQuestForm.querySelector('input').value;
    let currentPage = 1;
    
    const elts = listeQ.children;
    const nbrVal = elts.length;
    const nbrPage = Math.ceil(nbrVal / nbrParPage);
    
    showCurrent = (current) => {
        hidePagi(elts);
        for(i=(current-1)*nbrParPage; i<current*nbrParPage; i++){
            if(i === elts.length){
                break;
            }else{
                elts[i].style.display = "";
            }
        }
        if(current <= 1){
            btnPrev.style.display = "none";
            btnPrev.parentElement.style.justifyContent = "flex-end";
        }else{
            btnPrev.style.display = "";
        }
        if(current >= nbrPage){
            btnNext.style.display = "none";
            btnNext.parentElement.style.justifyContent = "flex-start";
            
        }else{
            btnNext.style.display = "";
        }
    }
    
    btnNext.addEventListener('click', () => {
        currentPage++;
        showCurrent(currentPage);
    })
    
    btnPrev.addEventListener('click', () => {
        currentPage--;
        showCurrent(currentPage);
    })
    
    
    
    showCurrent(currentPage);
}

/************************ INTERFACE QUESTIONS PAGINATION ************************/
const interfaceForm = document.getElementById("interfaceForm");
let score = 0;
let bonneRep = [];
document.cookie = "bonneRep=";
document.cookie = "score=";
if(interfaceForm != null){
    let currentTab = 0;
    let check = true;
    const tabEls = interfaceForm.querySelectorAll('.tabInterface');
    
    interfaceForm.addEventListener('submit', e => {
        e.preventDefault();
        if(currentTab >= tabEls.length){
            document.cookie = "score="+score;
            document.cookie = "bonneRep="+bonneRep;
            location.replace("./index.php?page=quizz&terminer");
        }
    })
    
    showCurrent = (current) => {
        tabEls[current].style.display = 'block';
        if(current == 0){
            btnPrev.style.display = 'none';
            btnPrev.parentElement.style.justifyContent = "flex-end";
        }else{
            btnPrev.parentElement.style.justifyContent = "space-between";
            btnPrev.style.display = '';
        }
        if(current == (tabEls.length - 1)){
            btnNext.innerText = 'Terminer';
            btnNext.setAttribute('name', 'terminer');
            btnNext.setAttribute('type', 'submit');
        }else{
            btnNext.innerHTML = 'Suivant';
        }
    }
    
    btnNext.addEventListener('click', () => {
        tabEls[currentTab].style.display = 'none';
        if(tabs[currentTab].typeRep === 'texte'){
            disabled = tabEls[currentTab].querySelector('input[id=repText]').disabled;
        }else{
            disabled = tabEls[currentTab].querySelector('input[id=resp]').disabled;
        }
        if(check && !disabled){
            if(verifierRep()){
                score += parseInt(tabs[currentTab].nbrPoints);
                bonneRep.push(tabs[currentTab].id);
            }
        }
        updateForm(currentTab);
        currentTab++;
        check = true;
        showCurrent(currentTab);
    });
    
    btnPrev.addEventListener('click', () => {
        check = false;
        tabEls[currentTab].style.display = '';
        currentTab--;
        showCurrent(currentTab);
    });
    
    verifierRep = () => {
        // This function deals with validation of the form fields
        const inputEl = tabEls[currentTab].querySelectorAll('input[id=resp]:checked');
        const inputTextEl = tabEls[currentTab].querySelectorAll('input[id=repText]');
        // Verifier si les réponses sont identiques
        if((tabs[currentTab]).typeRep === 'texte'){
            return tabs[currentTab].reponse[0].toLowerCase() == inputTextEl[0].value.toLowerCase();
        }else{
            let checkboxesChecked = [];
            for (var i=0; i<inputEl.length; i++){
                if (inputEl[i].checked) {
                    checkboxesChecked.push(inputEl[i].value);
                }
            }
            return tabs[currentTab].repC.join() == checkboxesChecked.join();
        }
        
    }
    
    updateForm = (n) => {
        const inputEl = tabEls[n].querySelectorAll('#resp');
        const inputTextEl = tabEls[currentTab].querySelector('input[id=repText]');
        if((tabs[currentTab]).typeRep === 'texte'){
            inputTextEl.setAttribute('disabled', '');
        }else{
            for (i = 0; i < inputEl.length; i++) {
                inputEl[i].setAttribute('disabled', '');
            }
        }
    }

    showCurrent(currentTab);
    
}

/************************ SCORES PAGINATION ************************/
const btns = document.querySelectorAll('[data-id]');

if(btns != null){
    let currentTab = document.querySelector('.is-visible');
    let currentTabButton = document.querySelector('.active');
    btns.forEach(el => {
        el.addEventListener('click', () => {
            const id = el.getAttribute('data-id')
            const tab = document.querySelector(`#${id}`)
            if (currentTab == tab) {
                return false;
            }
            el.classList.add('active')
            if (currentTab) {
                currentTab.classList.remove('is-visible')
            }
            if (currentTabButton) {
                currentTabButton.classList.remove('active')
            }
            currentTabButton = el;
            currentTab = tab;
            tab.classList.add('is-visible');
        });
    })
}
