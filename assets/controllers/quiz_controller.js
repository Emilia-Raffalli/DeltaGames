// import { Controller } from '@hotwired/stimulus';

// export default class extends Controller {
//     static targets = ['dropDownContent', 'dropDownLink', 'flagImgBtn', 'dropDownLinkImg', 'linkLangage'];

//     connect() {
//         console.log('Hello');
//     }

//     toggle() {
//         this.dropDownContentTarget.classList.toggle("visible");
//     }


//     // selectLanguage(event) {
//     //     const selectedLink = event.currentTarget;
//     //     const flagImg = selectedLink.querySelector('.flag').src;
//     //     const languageText = selectedLink.textContent.trim();
//     //     const flagTitle = selectedLink.querySelector('.flag').getAttribute('title');        
//     //     console.log(flagTitle);
    


//     //     // const firstLangButton = document.querySelector('.btn-langage');
//     //     const firstLangButton = this.linkLangageTarget;
//     //     if (firstLangButton) {
//     //         firstLangButton.innerHTML = `<img src="${flagImg}" alt="${flagTitle}" class="flag-img">${languageText}`;
//     //     }
//     //     //méthode ok mais drapeau trop gros !
//     // }
    
// }




import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['dropDownContent', 'dropDownLink', 'flagImgBtn', 'dropDownLinkImg', 'linkLangage'];

    connect() {
        console.log('Hello');

        this.loadLanguageFromLocalStorage();
    }

    toggle() {
        this.dropDownContentTarget.classList.toggle("visible");
    }

    loadLanguageFromLocalStorage() {
        const selectedLanguage = localStorage.getItem('selectedLanguage');
        if (selectedLanguage) {
            const { flagImg, languageText, flagTitle } = JSON.parse(selectedLanguage);
            const firstLangButton = this.linkLangageTarget;
            if (firstLangButton) {
                firstLangButton.innerHTML = `<img src="${flagImg}" alt="${flagTitle}" class="flag-img">${languageText}`;
            }
        }
    }

    selectLanguage(event) {
        const selectedLink = event.currentTarget;
        const flagImg = selectedLink.querySelector('.flag').src;
        const languageText = selectedLink.textContent.trim();
        const flagTitle = selectedLink.querySelector('.flag').getAttribute('title');        

        localStorage.setItem('selectedLanguage', JSON.stringify({
            flagImg,
            languageText,
            flagTitle
        }));

        const firstLangButton = this.linkLangageTarget;
        if (firstLangButton) {
            firstLangButton.innerHTML = `<img src="${flagImg}" alt="${flagTitle}" class="flag-img">${languageText}`;
        }
    }
}

