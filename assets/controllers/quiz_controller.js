import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['dropDownContent', 'dropDownLink', 'flagImgBtn', 'dropDownLinkImg', 'linkLangage'];

    connect() {
        console.log('Hello');
    }

    toggle() {
        this.dropDownContentTarget.classList.toggle("visible");
    }

    // selectLanguage(event) {
    //     const selectedLink = event.currentTarget;
    //     const flagImg = selectedLink.querySelector('.flag').src;
    //     let langageContent = this.linkLangageTarget.textContent.trim(); 
    //     console.log(langageContent);
    //     langageContent = selectedLink.textContent.trim();

        
    //     // console.log(selectedLink.querySelector('.flag').textContent);
    //     // langageContent = selectedLink.textContent.trim();
        
    //     // console.log(selectedLink.textContent.trim());
    //     // console.log(this.flagImgBtnTarget.src = selectedLink.querySelector('.flag').src);

    //     // console.log(this.linkLangageTarget.textContent = selectedLink.textContent);

    //     // console.log(this.flagImgBtnTarget.src);
    //     // const flagSrc = flagImg.src;
    //     // const langCode = selectedLink.dataset.lang;

    //     // this.linkLangageTarget.textContent = selectedLink.textContent.trim();
    //     // this.flagImgBtnTarget.src = flagSrc;
    // }
    // selectLanguage(event) {
    //     const selectedLink = event.currentTarget;
    //     const flagImg = selectedLink.querySelector('.flag').src;
    //     let languageContent = selectedLink.textContent.trim();
    //     console.log(languageContent); 
    //     this.linkLangageTarget.textContent = languageContent;
    //     this.flagImgBtn = flagImg;
    // }

    selectLanguage(event) {
        const selectedLink = event.currentTarget;
        const flagImg = selectedLink.querySelector('.flag').src;
        const languageText = selectedLink.textContent.trim();
        const flagTitle = selectedLink.querySelector('.flag').getAttribute('title');        
        console.log(flagTitle);
    
        // const firstLangButton = document.querySelector('.btn-langage');
        const firstLangButton = this.linkLangageTarget;
        if (firstLangButton) {
            firstLangButton.innerHTML = `<img src="${flagImg}" alt="${flagTitle}" class="flag-img">${languageText}`;
        }
        //méthode ok mais drapeau trop gros !
    }


    // selectLanguage(event) {
    //     const selectedLink = event.currentTarget;
    //     const flagImg = selectedLink.querySelector('.flag').src; 
    //     const languageText = selectedLink.textContent.trim(); 
    
    //     const firstLangButton = this.linkLangageTarget;
    
    //     if (firstLangButton) {
    //         const imgElement = document.createElement('img');
    //         imgElement.src = flagImg; 
    //         imgElement.alt = 'Flag';
    
    //         // Efface le contenu existant du premier lien de la classe 'btn-langage'
    //         while (firstLangButton.firstChild) {
    //             firstLangButton.removeChild(firstLangButton.firstChild);
    //         }
    
    //         // Ajoute l'élément image et le texte au premier lien de la classe 'btn-langage'
    //         firstLangButton.appendChild(imgElement);
    //         firstLangButton.appendChild(document.createTextNode(languageText));
    //     }
    // }




    // selectLanguage(event) {
    //     const selectedLink = event.currentTarget;
    //     const flagImg = selectedLink.querySelector('.flag');
    //     const flagSrc = flagImg.src;
    
    //     if (this.flagImgBtnTarget && this.linkLangageTarget) {
    //         this.flagImgBtnTarget.src = flagSrc;
    //         this.linkLangageTarget.textContent = selectedLink.textContent;
    //     }
    // }
    
}
