document.addEventListener('DOMContentLoaded', function () {

// Get all possible auto tab blocks 
const blocksTabs = document.querySelectorAll('.wp-block-auto-tabs');

// Generate a tab for each content and get label text from content title
const generateTabs = function (titleSelector, tabsContainer, contents) {
    let allTabs = '';
    contents.forEach((content, i) => {
        const title = content.querySelector(titleSelector);
        const label = title ? title.innerText : i + 1;
        allTabs += `<a href="#" data-order="${i + 1}">${label}</a>`;
    });

    tabsContainer.innerHTML = allTabs;
}

// Show/hide tabs & Content
const showHideTabs = function (tabsContainer, contentContainer, idTab) {

    //tabs
    tabsContainer.querySelectorAll('a').forEach(tab => tab.classList.remove('current-tab'));
    tabsContainer.querySelector(`*:nth-child(${idTab})`).classList.add('current-tab');

    //content
    contentContainer.querySelectorAll(':scope >*').forEach(content => content.classList.remove('show-content-tab'));
    contentContainer.querySelector(`:scope >*:nth-child(${idTab})`).classList.add('show-content-tab');
}

// 
blocksTabs.forEach(block => {

    // Variables
    const selector = block.dataset.selector;
    const tabsContainer = block.querySelector('.auto-tabs-wrapper');
    const contentContainer = block.querySelector('.auto-content-wrapper');
    const contents = block.querySelectorAll('.auto-content-wrapper>*');

    //check if some content has '.show-content-tab'
    const defaultContent = contentContainer.querySelector('.show-content-tab');
    let initContent;
    


    if (defaultContent) { // show default tab
        const index = Array.from(
            defaultContent.parentElement.children
        ).indexOf(defaultContent);
        initContent = index + 1;
    } else {
        initContent = 1; // show first tab
        
    }


    generateTabs(selector, tabsContainer, contents);
    showHideTabs(tabsContainer, contentContainer, initContent);


    tabsContainer.addEventListener('click', (e) => {
        const clicked = e.target.closest('a');
        if (!clicked) return
        e.preventDefault();
        const idTab = clicked.dataset.order;
        showHideTabs(tabsContainer, contentContainer, idTab);
    })

});

})