$(document).ready(()=>{
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            entry.target.classList.toggle('show', entry.isIntersecting);
        })
    },
    {
        rootMargin: "-30px"
    }
    );
    
    const menuItems = document.querySelectorAll(".menuItem")
    menuItems.forEach(menuItem=>{
        observer.observe(menuItem);
    });
    
});
