var tabLinks = document.getElementsByClassName('tab-links');
console.log('hello');
function clicked()
{
    console.log('hello');
    for(var tablink of tabLinks)
    {
        tablink.classList.remove('selected');
    }
    event.currentTarget.classList.add('selected');
}

const cardList = document.querySelector('.card-list');
const dragging =(e)=>{
    console.log(e.pageX);
    cardList.scrollLeft = e.pageX;
}
cardList.addEventListener('mousemove',dragging);
