//sec-2

const leftbtn = document.querySelector(".l-btn");
const rightbtn = document.querySelector(".r-btn");

//sec-3

const lefbtn = document.querySelector(".lf-btn");
const rigbtn = document.querySelector(".rg-btn");


function btnBackTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    })
}

function notContent() {
    alert("Chưa phân bổ nội dung")
}


rightbtn.addEventListener('click', (event) => {
    console.log("done");
    const content = document.querySelector('.product-slide');
    content.scrollLeft += 1100;
    event.preventDefault();
});

leftbtn.addEventListener('click', (event) => {
    console.log("done");
    const content = document.querySelector('.product-slide');
    content.scrollLeft -= 1100;
    event.preventDefault();
});


rigbtn.addEventListener('click', (event) => {
    console.log("done");
    const content = document.querySelector('.product-slide-thir');
    content.scrollLeft += 1100;
    event.preventDefault();
});

lefbtn.addEventListener('click', (event) => {
    console.log("done");
    const content = document.querySelector('.product-slide-thir');
    content.scrollLeft -= 1100;
    event.preventDefault();
});


const sidebar = document.querySelector(".sidebar");
const cross = document.querySelector(".fa-xmark");
const siBlack = document.querySelector(".si-black");
const sidebtn = document.querySelector(".second-1");

function btnSide() {
    sidebar.classList.add("active");
    cross.classList.add("active");
    siBlack.classList.add("active");
}

function crSide() {
    sidebar.classList.remove("active");
    cross.classList.remove("active");
    siBlack.classList.remove("active");
}

