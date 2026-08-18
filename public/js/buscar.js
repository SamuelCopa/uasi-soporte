//BUSCAR DEPENDENCIA
//---------------------CPU--------------------------------
const searchInputC = document.getElementById('search-inputC');
const optionsC = document.getElementById('optionsC').options;
const idSelectedInputC = document.getElementById('id-selectedC');

searchInputC.addEventListener('input', () => {
    const selectedOption = Array.from(optionsC).find(option => option.value === searchInputC.value);
    if (selectedOption) {
        idSelectedInputC.value = selectedOption.dataset.id;
    }
});
//---------------------IMPRESORA--------------------------------
const searchInputI = document.getElementById('search-inputI');
const optionsI = document.getElementById('optionsI').options;
const idSelectedInputI = document.getElementById('id-selectedI');

searchInputI.addEventListener('input', () => {
    const selectedOption = Array.from(optionsI).find(option => option.value === searchInputI.value);
    if (selectedOption) {
        idSelectedInputI.value = selectedOption.dataset.id;
    }
});
//---------------------MONITOR--------------------------------
const searchInputM = document.getElementById('search-inputM');
const optionsM = document.getElementById('optionsM').options;
const idSelectedInputM = document.getElementById('id-selectedM');

searchInputM.addEventListener('input', () => {
    const selectedOption = Array.from(optionsM).find(option => option.value === searchInputM.value);
    if (selectedOption) {
        idSelectedInputM.value = selectedOption.dataset.id;
    }
});
//---------------------AUDIFONO--------------------------------
const searchInputA = document.getElementById('search-inputA');
const optionsA = document.getElementById('optionsA').options;
const idSelectedInputA = document.getElementById('id-selectedA');

searchInputA.addEventListener('input', () => {
    const selectedOption = Array.from(optionsA).find(option => option.value === searchInputA.value);
    if (selectedOption) {
        idSelectedInputA.value = selectedOption.dataset.id;
    }
});
//---------------------TECLADO--------------------------------
const searchInputT = document.getElementById('search-inputT');
const optionsT = document.getElementById('optionsT').options;
const idSelectedInputT = document.getElementById('id-selectedT');

searchInputT.addEventListener('input', () => {
    const selectedOption = Array.from(optionsT).find(option => option.value === searchInputT.value);
    if (selectedOption) {
        idSelectedInputT.value = selectedOption.dataset.id;
    }
});
//---------------------PARLANTE--------------------------------
const searchInputP = document.getElementById('search-inputP');
const optionsP = document.getElementById('optionsP').options;
const idSelectedInputP = document.getElementById('id-selectedP');

searchInputP.addEventListener('input', () => {
    const selectedOption = Array.from(optionsP).find(option => option.value === searchInputP.value);
    if (selectedOption) {
        idSelectedInputP.value = selectedOption.dataset.id;
    }
});
//---------------------MOUSE--------------------------------
const searchInputR = document.getElementById('search-inputR');
const optionsR = document.getElementById('optionsR').options;
const idSelectedInputR = document.getElementById('id-selectedR');

searchInputR.addEventListener('input', () => {
    const selectedOption = Array.from(optionsR).find(option => option.value === searchInputR.value);
    if (selectedOption) {
        idSelectedInputR.value = selectedOption.dataset.id;
    }
});
//---------------------UPS--------------------------------
const searchInputU = document.getElementById('search-inputU');
const optionsU = document.getElementById('optionsU').options;
const idSelectedInputU = document.getElementById('id-selectedU');

searchInputU.addEventListener('input', () => {
    const selectedOption = Array.from(optionsU).find(option => option.value === searchInputU.value);
    if (selectedOption) {
        idSelectedInputU.value = selectedOption.dataset.id;
    }
});
//---------------------ESTABILIZADOR--------------------------------
const searchInputE = document.getElementById('search-inputE');
const optionsE = document.getElementById('optionsE').options;
const idSelectedInputE = document.getElementById('id-selectedE');

searchInputE.addEventListener('input', () => {
    const selectedOption = Array.from(optionsE).find(option => option.value === searchInputE.value);
    if (selectedOption) {
        idSelectedInputE.value = selectedOption.dataset.id;
    }
});
//---------------------LAPTOP--------------------------------
const searchInputL = document.getElementById('search-inputL');
const optionsL = document.getElementById('optionsL').options;
const idSelectedInputL = document.getElementById('id-selectedL');

searchInputL.addEventListener('input', () => {
    const selectedOption = Array.from(optionsL).find(option => option.value === searchInputL.value);
    if (selectedOption) {
        idSelectedInputL.value = selectedOption.dataset.id;
    }
});
