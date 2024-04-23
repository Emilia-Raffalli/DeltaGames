import { Controller } from '@hotwired/stimulus';
/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {

    static targets = ['dropDownContent', 'dropDownLink', 'flagImgBtn', 'dropDownLinkImg'];

    connect() {
        // this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/hello_controller.js';
        console.log('Hello');
    }

    toggle() {
        // this.dropDownContentTarget.classList.toggle("d-block");
        this.dropDownContentTarget.classList.toggle("visible");

        // this.dropDownContentTarget.classList.toggle("d-none");

    }


    selectLanguage(event) {
        const selectedLink = event.currentTarget;
        let flagSrc = this.dropDownLinkImgTarget.src;
        let countryTitle = this.ropDownLinkImgTarget.title;

        console.log(selectedLink);

        flagSrc = selectedLink.querySelector('.flag').src;
        countryTitle = electedLink.querySelector('.flag').title;
        
        this.flagImgBtnTarget.src = flagSrc;
    }



    // selectLanguage(event) {
    //     const selectedLink = event.currentTarget;
    //     const flagImg = selectedLink.querySelector('.flag');
    //     const flagSrc = selectedLink.querySelector('.flag').src;
    //     const langCode = selectedLink.dataset.lang;

    //     flagImg.alt = selectedLink.textContent.trim();

    //     flagImg.title = selectedLink.textContent.trim();

    //     this.element.querySelector('.btn-langage').textContent = selectedLink.textContent.trim();

    //     this.flagImgBtnTarget.src = flagSrc;
    // }



    // selectLanguage() {
    // //si un dropDownLinkTarget est selectionné, l'image flagImgTarget prend le chemin de l'image du dropDownLinkTarget, le content du lien de la class btn-lange devient le content du dropdownLink selectionné
    //     this.flagImgBtnTarget.src = 


    //     // const lang = event.target.dataset.lang;
    //     // const flagSrc = event.target.querySelector('.flag').src;

    //     // this.dropDownContentTarget.textContent = lang;
    //     // this.dropDownContentTarget.src = flagSrc;
    // }


    // selectLanguage() {
    //     const flagSrc = this.dropDownLinkImgTarget.src;
    //     console.log(flagSrc);
    
    //     this.flagImgBtnTarget.src = flagSrc;
    
    //     // this.element.querySelector('.btn-langage').innerHTML = this.dropDownLinkTarget.innerHTML;
    
    //     // this.dropDownContentTarget.classList.remove('d-block');
    // }


}
