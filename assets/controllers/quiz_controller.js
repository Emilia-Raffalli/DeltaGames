import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['dropDownContent', 'dropDownLink', 'flagImgBtn', 'dropDownLinkImg', 'linkLangage'];
    openedWindow = null; 

    connect() {
        //récupération des informations de langues dans le localStorage 
        this.loadLanguageFromLocalStorage();
    }

    toggle() {
        this.dropDownContentTarget.classList.toggle("visible");
    }

    loadLanguageFromLocalStorage() {
        let langCode = document.getElementById('langCode').value

        console.log('langCode')
        console.log(langCode)

        let selectedLanguage = JSON.stringify({
            flagImg: "https://flagcdn.com/w2560/gb.png",
            languageText: "EN",
            flagTitle: "English"
        });

        let langElement = document.getElementById(langCode)
        console.log(langElement)
        if(langElement) {
            console.log(langElement)
            const flagImg = langElement.src;
            const languageText = langCode.toUpperCase();
            const flagTitle = langElement.getAttribute('title');

            selectedLanguage = JSON.stringify({
                flagImg,
                languageText,
                flagTitle
            });

            localStorage.setItem('selectedLanguage', selectedLanguage);
        }
    
        const { flagImg, languageText, flagTitle } = JSON.parse(selectedLanguage);
        
        const firstLangButton = this.linkLangageTarget;
    
        if (firstLangButton) {
            firstLangButton.innerHTML = `<img src="${flagImg}" alt="${flagTitle}" class="flag-img">${languageText}`;
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


    // // openWindow(event) {
    
    // //     const url = event.currentTarget.dataset.url;
    // //     this.openedWindow = window.open(url);
    // //     // console.log(url);
    // // }
    // openWindow(event) {
    //     const url = event.currentTarget.dataset.url;
    //     window.open(url);
    // }
    
    // closeWindow() {
    //     window.close();       
    // }

}

