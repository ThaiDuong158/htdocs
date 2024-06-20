const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const header = $('.header')
const content = $('.content')
const footer = $('.footer')
const sidebarHides = $$('.sidebar-hide')
const sidebarWidths = $$('.sidebar-width')
const sidebarBtn = $('.sidebar-mini')
const sidebarItems = $$('.sidebar-item')
const path = window.location.pathname;

let contentDefaultHeight = content.clientHeight

function updateContentHeight() {
    // const totalHeight = footer.clientHeight;
    const contentHeight = window.innerHeight - header.clientHeight - footer.clientHeight;
    if (contentDefaultHeight < contentHeight) {
        content.style.height = contentHeight + "px";
    }
}

updateContentHeight()
window.addEventListener('resize', updateContentHeight);

let sidebarHide = () => {
    sidebarHides.forEach(sidebarHide => {
        sidebarHide.classList.toggle("sidebar-small-hide");
    });
    sidebarWidths.forEach(sidebarWidth => {
        sidebarWidth.classList.toggle("sidebar-small-width");
    });
}

sidebarBtn.addEventListener('click', sidebarHide)

sidebarItems.forEach(sidebarItem => {
    if (sidebarItem.getAttribute('href') === `..${path}`) {
        sidebarItem.setAttribute('href', '#');
        let sidebarLeftLight = $('.sidebar-item.left-line')
        sidebarLeftLight.classList.remove("left-line")
        sidebarItem.classList.add("left-line")
    }
})