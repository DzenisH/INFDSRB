const relative = document.getElementById("relative");
const dropdown = document.getElementById("dropdown");
relative.addEventListener("mouseover",() => {
    dropdown.style.display="flex";
    relative.style.height="100%";
})

relative.addEventListener("mouseout",() => {
    dropdown.style.display="none";
})