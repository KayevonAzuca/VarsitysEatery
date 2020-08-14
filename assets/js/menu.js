window.addEventListener("load", main);

//Formats a number(price) to have the proper two decimal places.
function formatPrice(price){
    return price.toFixed(2);
}//end of formatPrice()

//Check url parameter for a matching category to display on page load.
//Otherwise use "pageDefault" is true to display that category data on page load.
function displayDefaultPage(menu){
    let urlParam = new URLSearchParams(location.search);
    if(urlParam.has('category')){
        let urlCategory = urlParam.get('category');
        for(let i = 0; i < menu.length; i++){
            if(urlCategory === menu[i].category){
                displayCategoryData(urlCategory, menu);
                break;
            }//end of if()
        }//end of for()
    } else {
        for(let j = 0; j < menu.length; j++){
            if(menu[j].pageDefault === true){
                displayCategoryData(menu[j].category, menu);
                break;
            }//end of if()
        }//end of for()
    }//end of else{}
}//end of displayDefaultPage()

//Display the menu categories.
function displayMenuCategories(menu){
    document.getElementById('menuNav').innerHTML = `
        <ul class="menu__list">
            ${
                menu.map(function(categories){
                    return `<li class="menu__category">
                                ${categories.category}
                            </li>`
                }).join('')
            }
        </ul>`;
}//end of displayMenuCategories()

//Add the click event for each menu category.
function addCategoryEvent(menu){
    let categories = document.getElementsByClassName('menu__category');
    for(let i = 0; i< categories.length; i++){
        categories[i].addEventListener('click', function (e) {
            displayCategoryData(e.target.innerText, menu);
        });
    }//end of for()
}//end of addCategoryEvent()

//Display category info, title, and food items
function displayCategoryData(clickedCategory, menu){
    for(let i = 0; i < menu.length; i++){
        if(menu[i].category === clickedCategory){
            //Highlight clicked category while removing potential previous highlighted category
            let menuCategories = document.getElementsByClassName('menu__category');
            for(let k = 0; k < menuCategories.length; k++){
                if(clickedCategory === menuCategories[k].innerText){
                    menuCategories[k].classList.add('category--highlight');
                } else {
                    menuCategories[k].classList.remove('category--highlight');
                }//end of else{}
            }//end of for()
            //Display category info
            let info = document.getElementsByClassName('menu__info');
            for(let j = 0; j < info.length; j++){
                info[j].innerHTML = `${menu[i].info}`
            }//end of for()
            //Display category title
            document.getElementById('categoryTitle').innerHTML = `${menu[i].category}`
            //Display category food items
            document.getElementById('category').innerHTML = 
                `<ul class="category__list">
                ${
                    menu[i].items.map(function(item){
                        return `
                            <li class="category__item">
                                <img class="category__img" src="${item.imgPath}" alt="${item.alt}">
                                <div class="category__details">
                                <h3 class="category__title">${item.name}</h3>
                                <p class="category__description">${item.description}</p>
                                <span class="category__price">$${formatPrice(item.price)}</span>
                                </div>
                            </li>`
                    }).join('')
                }
                </ul>`
            break;
        }//end of if()
    }//end of for()
}//end of displayCategoryData()

//Display error message in menu page when JSON failed to load
function displayPageError(){
    let info = document.getElementsByClassName('menu__disclaimer');
    for(let i = 0; i < info.length; i++){
        info[i].innerText = 'Something went wrong. Sorry for the inconvenience.';
    }//end of for()
}//end of displayPageError()

//Get JSON file and execute functions once on page load
async function displayMenu(){
    let response = await fetch('assets/json/menu.json');
    response = await response.json();
    await displayMenuCategories(response);
    await displayDefaultPage(response);
    await addCategoryEvent(response);
}//end of displayMenu()

function main(){
    displayMenu().then(response => {
        console.log('Menu processed.');
    }).catch(e => {
        console.log('JSON load error: "Sorry for the inconvenience"');
        console.log(e);
        displayPageError();
    });
}//end of main()